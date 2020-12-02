<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * Default response for API
     *
     * @param  string  $message
     * @param  Mixed   $data
     * @param  integer $statusCode
     *
     * @return JsonResponse
     */
    public function apiResponse(
        string $message,
        $data = null,
        $statusCode = 200
    ): JsonResponse {
        return response()->json(compact('message', 'data'), $statusCode);
    }
}
