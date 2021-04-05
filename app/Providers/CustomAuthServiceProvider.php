<?php

namespace App\Providers;

use App\Library\CustomAuth;
use Illuminate\Support\ServiceProvider;

class CustomAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Library\Contracts\CustomAuthInterface', function ($app) {
            return new CustomAuth();
        });
    }
}
