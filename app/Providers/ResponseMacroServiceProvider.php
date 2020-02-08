<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($value, $status = 200) {
            if (! is_array($value)) {
                $value = ['message' => $value];
            }

            return Response::json($value, $status);
        });

        Response::macro('error', function ($value, $status = 500) {
            if (! is_array($value)) {
                $value = ['message' => $value];
            }

            return Response::json($value, $status);
        });
    }
}
