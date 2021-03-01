<?php

namespace App\Http\Middleware;

use App\Models\Recruiter;

class Authenticate
{
    public function handle($request, \Closure $next, ...$params)
    {
        if (is_null($request->header('token')) || is_null($request->header('email'))) {
            return response()->json(
                [
                    'status' => [
                        "code" => 401,
                        "message" => 'Unauthorized'
                    ]
                ]
            );
        }

        $recruiterModel = Recruiter::class;
        $recruiter = $recruiterModel::where('access_token', $request->header('token'))->where('email', $request->header('email'))->first();

        if(is_null($recruiter)) {
            return response()->json(
                [
                    'status' => [
                        "code" => 401,
                        "message" => 'Unauthorized'
                    ]
                ]
            );
        }

        return $next($request);
    }
}
