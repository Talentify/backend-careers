<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            throw new HttpResponseException(response(['error' => 'Unauthorized'], 401));
        }

        return $this->responseWithToken($token);

    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out!']);
    }

    public function refresh()
    {
        return $this->responseWithToken(auth()->refresh());
    }

    public function me()
    {
        return new UserResource(Auth::user());
    }

    protected function responseWithToken(string $token)
    {
        return response()->json(
            [
                'access_token'  => $token,
                'token_type'    =>  'bearer',
                'expires_in'    =>  auth()->factory()->getTTL() * 60,
            ]
        );
    }
}
