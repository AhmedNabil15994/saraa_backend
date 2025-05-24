<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\EntityRepositoryInterface;

// use App\Repositories\EloquentBlogRepository;
// use App\Repositories\EloquentRoleRepository;
// use App\Repositories\EloquentUserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $modules = config("modules.modules");
        foreach ($modules as $module) {
            $repoName = '\\App\\Repositories\\Eloquent'.$module.'Repository'::class;
            $this->app->bind(
                EntityRepositoryInterface::class,
                $repoName
            );
        }
   
        // $this->app->bind(
        //     EntityRepositoryInterface::class,
        //     EloquentBlogRepository::class
        // );

        // $this->app->bind(
        //     EntityRepositoryInterface::class,
        //     EloquentRoleRepository::class
        // );

        // $this->app->bind(
        //     EntityRepositoryInterface::class,
        //     EloquentUserRepository::class
        // );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
