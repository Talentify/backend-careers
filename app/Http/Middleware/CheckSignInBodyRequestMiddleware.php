<?php

namespace App\Http\Middleware;

use App\Models\Recruiter\CheckSignInBodyRequest;
use Closure;
use Illuminate\Http\Request;

class CheckSignInBodyRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            CheckSignInBodyRequest::check($request);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }
}
