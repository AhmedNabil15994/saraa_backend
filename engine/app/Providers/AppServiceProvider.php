<?php

namespace App\Providers;

use App\Repositories\PaymentRepository;
use App\Services\Payment\Contract\PaymentInterface;
use App\Services\Payment\KnetPaymentService;
use App\Services\Payment\MyFatoorahPaymentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    
    protected $mapPaymentGetWay = [
        "my_fatoorah" => MyFatoorahPaymentService::class,
        "knet" => KnetPaymentService::class,
    ];
    
    public function register()
    {
        $this->app->singleton(
            PaymentInterface::class,
            function ($app) {
                $class =   $this->mapPaymentGetWay["knet"];
                if (isset($this->mapPaymentGetWay[config("services.payment.default")])) {
                    $class =   $this->mapPaymentGetWay[config("services.payment.default")];
                }
                return  new $class;
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
