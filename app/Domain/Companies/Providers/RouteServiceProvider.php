<?php

namespace App\Domain\Companies\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    protected $namespace = '\App\Domain\Companies\Controller';

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
            ->group(app_path('Domain/Companies/Routes/api.php'));
    }
}
