<?php

namespace App\Http\Controllers;

use App\Http\Services\JwtService;
use App\Models\Recruiter\SignInRecruiter;
use App\Models\Recruiter\SignUpRecruiter;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    public function signIn(Request $request)
    {
        try {
            $recruiter =SignInRecruiter::signIn($request);

            $token = JwtService::generateToken($recruiter);

            return response()->json(['token' => $token], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function signUp(Request $request)
    {
        try {
            SignUpRecruiter::store($request);

            return response()->json([], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }


}
