<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Exception;

class Authenticate extends Middleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if($this->auth->guard('api')->check()) {
            return $next($request);
        }

        return response('Unauthenticated',401);
    }
}
