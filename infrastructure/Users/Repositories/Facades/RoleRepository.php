<?php

namespace Infrastructure\Users\Repositories\Facades;

use Illuminate\Support\Facades\Facade;
use Infrastructure\Users\Repositories\Contracts\RoleRepositoryContract;

class RoleRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RoleRepositoryContract::class;
    }
}
