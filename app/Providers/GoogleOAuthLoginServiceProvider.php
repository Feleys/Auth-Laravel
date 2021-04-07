<?php

namespace App\Providers;

use App\Library\CustomAuth;
use App\Library\GoogleOAuthLogin;
use Illuminate\Support\ServiceProvider;

class GoogleOAuthLoginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GoogleOAuthLogin::class, function ($app) {
            return new GoogleOAuthLogin();
        });
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
