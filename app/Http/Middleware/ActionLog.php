<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ActionLog
{
    /**
     * Handle an incoming request.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   \Closure                  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $logData             = [];
        $logData["user"]     = Auth::user()->id;
        $logData["action"]   = $request->getRequestUri();
        $response            = $next($request);
        $logData["response"] = [
            'status' => $response->getStatusCode(),
            'data'   => $response->getData()
        ];
        Log::info(json_encode($logData));

        return $response;
    }
}
