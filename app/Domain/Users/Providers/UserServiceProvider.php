<?php

namespace App\Domain\Users\Providers;

use Illuminate\Support\ServiceProvider;
use Infrastructure\Users\Repositories\Contracts\RoleRepositoryContract;
use Infrastructure\Users\Repositories\Contracts\UserRepositoryContract;
use Infrastructure\Users\Repositories\EloquentRoleRepository;
use Infrastructure\Users\Repositories\EloquentUserRepository;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, EloquentUserRepository::class);
        $this->app->bind(RoleRepositoryContract::class, EloquentRoleRepository::class);
    }
}
