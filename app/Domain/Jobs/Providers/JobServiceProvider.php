<?php

namespace App\Domain\Jobs\Providers;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Jobs\Repositories\Contracts\JobRepositoryContract;
use Infrastructure\Jobs\Repositories\EloquentJobRepository;

class JobServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(JobRepositoryContract::class, EloquentJobRepository::class);
    }
}
