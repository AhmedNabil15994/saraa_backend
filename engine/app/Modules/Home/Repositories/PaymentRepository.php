<?php namespace App\Repositories;

use App\Entities\Payment as Model;
use App\Entities\Reservation;
use App\Events\PaidEvent;
use App\Services\Payment\Contract\PaymentInterface;
use File;
use Illuminate\Support\Facades\DB;

class PaymentRepository
{
    public function __construct(Model $model, PaymentInterface $payment)
    {
        $this->model   = $model;
        $this->payment  = $payment;
    }

    public function getTransaction($id)
    {
        return $this->payment->getTransactionDetails($id);
    }

    public function findById($id, $with=[])
    {
        return $this->model->with($with)
                   ->where('order_id', $id)
                   ->where("status", "wait")
                   ->first();
    }

    public function successPayment($request, $gateway="knet")
    {
        DB::beginTransaction();
        if ($gateway == "knet") {
            $payment = $this->findById($request->OrderID, "order");
            $data    = $request->all();
        } elseif ($gateway == "myfatoorah") {
            $payment = $this->findById($request["UserDefinedField"], "order");
            $data    = $request;
        }

        abort_if(is_null($payment), "404");
        $data['method'] = $gateway;
        try {
            $payment->update([
                "status" => "paid",
                "transaction"=> $data
            ]);
            $order = $payment->order ;
            if ($order instanceof Reservation) {
                $this->handleSuccessReservation($payment, $order);
            }
            DB::commit();
            event(new PaidEvent($payment));
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function failedPayment($request, $gateway="knet")
    {
        DB::beginTransaction();
    
        if ($gateway == "knet") {
            $payment = $this->findById($request->OrderID, "order");
        } elseif ($gateway == "myfatoorah") {
            $payment = $this->findById($request["UserDefinedField"], "order");
        }

        abort_if(is_null($payment), "404");
        $data['method'] = $gateway;
        try {
            $order = $payment->order;
            $payment->delete();
            if (method_exists($order, "attachs")) {
                $order->attachs()->delete();
            }
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function handleSuccessReservation(&$payment, &$ads)
    {
        if ($ads) {
            return $ads->update([
                'status' => 1,
                'updated_at' => now(),
            ]);
        }
    }
}
