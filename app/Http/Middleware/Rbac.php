<?php

namespace App\Http\Middleware;

use Closure;

class Rbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rule = $request->route()->getName();

        $userRule = array_column($request->user()->rules->toArray(), 'code');

        if ($request->user()->role->code != 'admin' && array_search($rule, $userRule) === false) {
            return response()->json(['Not allowed'], 403);
        }

        return $next($request);
    }
}
