<?php

namespace App\Providers;

use App\Library\Contracts\CustomAuthInterface;
use App\Library\Contracts\OAuthLoginInterface;
use App\Library\CustomAuth;
use App\Library\GoogleOAuthLogin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CustomAuthInterface::class,
            CustomAuth::class
        );

        $this->app->bind(
            OAuthLoginInterface::class,
            GoogleOAuthLogin::class
        );
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
