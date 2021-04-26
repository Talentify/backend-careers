<?php

namespace App\Http\Middleware;

use Closure;
use Lindelius\JWT\Exception\JwtException;
use App\Http\Services\JwtService;

class Token
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
        try {
            $token = $request->header('Authorization');

            if (!$this->hasToken($token)) {
                return response()->json(['message' => 'Unsent Authorization.'], 403);
            }

            JwtService::validateToken($token);

            return $next($request);
        } catch (JwtException $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal server errror.'], 500);
        }
    }

    private function hasToken($token = false): bool
    {
        if (!$token) {
            return false;
        }

        return true;
    }

}
