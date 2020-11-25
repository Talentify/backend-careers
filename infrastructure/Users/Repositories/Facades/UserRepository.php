<?php

namespace Infrastructure\Users\Repositories\Facades;

use Illuminate\Support\Facades\Facade;
use Infrastructure\Users\Repositories\Contracts\UserRepositoryContract;

class UserRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserRepositoryContract::class;
    }
}
