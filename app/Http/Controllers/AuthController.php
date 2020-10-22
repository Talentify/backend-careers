<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request()->only('email', 'password');

        $token = Auth::attempt($credentials);

        if ($token) {
            return response()->json([
                'token' => $token
            ]);
        }

        return response()->json(['error' => 'Invalid Credentials'], 400);
    }
}
