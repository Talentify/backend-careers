<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login'
            ]
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return $this->returnSuccess('Logout successful');
    }

    public function login(Login $request)
    {
        try {
            if (!$token = auth()->attempt(
                    [
                        'username' => $request->username,
                        'password' => $request->password
                    ]
                    )
            ) {
                throw new \Exception('Unauthorized', 401);
            }

            return $this->returnSuccess(
                            'Login successful',
                            $this->createNewToken($token)
            );
        } catch (\Exception $ex) {
            return $this->returnException($ex);
        }
    }

    private function createNewToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ];
    }

}
