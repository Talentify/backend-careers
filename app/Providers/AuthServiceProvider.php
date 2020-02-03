<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Admin;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
       $this->app['auth']->viaRequest('user', function (Request $request) {
           if ($request->header('token')) {
                return User::where('api_token', $request->header('token'))
                    ->where('expires_token', '>=', Carbon::now())->first();
            }
        });
        $this->app['auth']->viaRequest('admin', function (Request $request) {
            if ($request->header('token')) {
                return Admin::where('api_token', $request->header('token'))
                    ->where('expires_token', '>=', Carbon::now())->first();
            }
        });
    }
}
