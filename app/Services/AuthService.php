<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthService
{
    public function login(Request $request) {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return ['msg' => 'Invalid email or password!'];
        }

        return $this->respondWithToken($token);
    }

    public function logout() {
        auth()->logout();

        return ['msg' => 'Successfully logged out!'];
    }

    public function refreshToken() {
        return $this->respondWithToken(auth()->refresh());
    }

    public function loggedUser(): Authenticatable {
        return auth()->user();
    }

    private function respondWithToken($token) {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }


}
