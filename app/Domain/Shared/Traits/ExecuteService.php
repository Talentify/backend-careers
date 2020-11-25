<?php

namespace App\Domain\Shared\Traits;

trait ExecuteService
{
    public function execute()
    {
        $args = collect(func_get_args());
        $service = $args->shift();
        return call_user_func_array($service, $args->all());
    }
}
