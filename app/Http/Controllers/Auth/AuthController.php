<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AuthRequest;

use App\Repositores\Contracts\UserRepositoryInterface;
use Laravel\Lumen\Routing\Controller;

/**
 * @OA\Info(
 *     description="API to search and create jobs",
 *     version="1.0",
 *     title="Jobs Find",
 *     @OA\Contact(
 *         email="filipemansano@gmail.com.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Server(
 *   url="http://localhost:8000/",
 *   description="Development server"
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * ),
 *
 *  @OA\Schema(
 *     schema="ErrorValidation",
 *     required={"message", "errors"},
 *     @OA\Property(
 *         property="errors",
 *         type="array",
 *         @OA\Items(type="string"),
 *     ),
 *     @OA\Property(
 *         property="message",
 *         type="string"
 *     )
 * )
 */
class AuthController extends Controller
{
    protected UserRepositoryInterface $entity;

    public function __construct(UserRepositoryInterface $entity){
        $this->entity = $entity;
        $this->middleware('auth:api', ['except' => ['singin']]);
    }

    /**
     * @OA\Post(
     *     path="/auth",
     *     summary="authenticate user and receive JWT",
     *     tags={"auth"},
     *     description="Perform user authentication based on your email and password, and if validated returns the JWT",
     *     operationId="singin",
     *     @OA\RequestBody(
     *        @OA\MediaType(mediaType="application/json",
     *            @OA\Schema(
     *                required={"email","password"},
     *                @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  default="admin@system.local",
     *                ),
     *                @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  default="password",
     *                ),
     *            )
     *        )
     *     ),
     *     @OA\Response(response=200,description="OK"),
     *     @OA\Response(
     *          response=422,
     *          description="invalid post data",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorValidation"),
     *      ),
     *     @OA\Response(response=401,description="unauthenticated user")
     * )
     */
    public function singin(AuthRequest $request)
    {
        $attributes = $request->only(['email', 'password']);

        if (! $token = auth()->attempt($attributes)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * @OA\Get(
     *     path="/auth/signout",
     *     summary="disconnect the user and invalidate the JWT",
     *     tags={"auth"},
     *     security={{ "apiAuth": {} }},
     *     description="revokes the informed JWT",
     *     operationId="signout",
     *     @OA\Response(response=200, description="OK"),
     *     @OA\Response(response=401, description="unauthenticated user")
     * )
     */
    public function signout()
    {
        auth()->logout();
        return response()->json(['message' => 'Deslogado com sucesso'], 200);
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
