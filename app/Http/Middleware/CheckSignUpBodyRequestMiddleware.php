<?php

namespace App\Http\Middleware;

use App\Models\Recruiter\CheckSignUpBodyRequest;
use Closure;
use Illuminate\Http\Request;

class CheckSignUpBodyRequestMiddleware
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
            CheckSignUpBodyRequest::check($request);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }
}
