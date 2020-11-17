<?php


namespace App\Infrastructure\Auth;


use Core\Controllers\AbstractController;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;

final class AuthController extends AbstractController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup']]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => ((auth()->factory()->getTTL()) * 60)
            ]
        );
    }

    public function signup(SignupRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $credentials = $request->validated();

            /**
             * como o metodo create chama o metodo fill do eloquent que só atribui os campos
             * que estão como fillable não é necessário passar somente os dados de criação do usuario
             */
            $user = User::create($data);
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->respondWithToken($token);
        } catch (\Throwable $throwable) {
            throw $throwable;
        }
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
