<?php

namespace App\Domain\Login\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    protected $namespace = '\App\Domain\Login\Controller';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::middleware(['api'])
            ->namespace($this->namespace)
            ->group(app_path('Domain/Login/Routes/api.php'));
    }
}
