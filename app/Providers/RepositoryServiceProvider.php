<?php

namespace App\Providers;

use App\Repositories\CompanyRepository;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\PositionRepositoryInterface;
use App\Repositories\Contracts\RecruiterRepositoryInterface;
use App\Repositories\PositionRepository;
use App\Repositories\RecruiterRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );
        $this->app->bind(
            RecruiterRepositoryInterface::class,
            RecruiterRepository::class
        );
        $this->app->bind(
            PositionRepositoryInterface::class,
            PositionRepository::class
        );
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
