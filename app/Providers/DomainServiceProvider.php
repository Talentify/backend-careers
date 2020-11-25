<?php

namespace App\Providers;

use App\Domain\Jobs\Providers\JobServiceProvider;
use App\Domain\Users\Providers\UserServiceProvider;
use Carbon\Laravel\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(UserServiceProvider::class);
        $this->app->register(JobServiceProvider::class);
    }
}
