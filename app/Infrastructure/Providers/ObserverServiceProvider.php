<?php

namespace Infrastructure\Providers;

use App\Domain\Users\Observers\UserObserver;
use Domain\Jobs\Models\Address;
use Domain\Jobs\Models\Job;
use Domain\Jobs\Observers\AddressObserver;
use Domain\Jobs\Observers\JobObserver;
use Domain\Users\Models\User;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
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
        Job::observe(JobObserver::class);
        Address::observe(AddressObserver::class);
        User::observe(UserObserver::class);
    }
}
