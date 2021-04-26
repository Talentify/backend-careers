<?php

namespace App\Http\Middleware;

use App\Models\Recruiter\CheckRecruiter;
use Closure;
use Illuminate\Http\Request;

class CheckRecruiterMiddleware
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
            $token = $request->header('Authorization');

            CheckRecruiter::check($token, $request->id);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        }
    }
}
