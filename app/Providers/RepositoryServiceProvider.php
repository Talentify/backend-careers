<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositores\Contracts\JobRepositoryInterface::class, \App\Repositores\Elloquent\JobRepository::class);
        $this->app->bind(\App\Repositores\Contracts\UserRepositoryInterface::class, \App\Repositores\Elloquent\UserRepository::class);
    }
}
