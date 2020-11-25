<?php

namespace Infrastructure\Jobs\Repositories\Facades;

use Illuminate\Support\Facades\Facade;
use Infrastructure\Jobs\Repositories\Contracts\JobRepositoryContract;

class JobRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return JobRepositoryContract::class;
    }
}
