<?php

namespace App\Auth\Controllers\Api;

use App\Auth\Exceptions\InvalidCredentialsException;
use App\Auth\Exceptions\UserNotFoundOnThisClientException;
use App\Auth\Services\AuthService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthController
 * @package App\Auth\Controllers\Api
 */
class AuthController extends Controller
{
//    use AuthenticatesUsers;

    /**
     * @var AuthService
     */
    private $authService;

    /**
     * Create a new AuthController instance.
     *
     * @param  AuthService  $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
        $this->authService = $authService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        try {
            $usernameColumn = $this->username();

            $user = $this->authService->findByUsername($credentials[$usernameColumn]);

            $client = $this->authService->getClientByOrigin($request);

            if ($user->default) {
                $token = $this->authService->attemptCredentials($credentials, $client);

                if (!$token) {
                    throw new InvalidCredentialsException();
                }
                return $this->respondWithToken($token);
            }

            $this->authService->verifyClientRelation($user, $client);

            $token = $this->authService->attemptCredentials($credentials, $client);

            if (!$token) {
                throw new InvalidCredentialsException();
            }

            return $this->respondWithToken($token);
        } catch (ModelNotFoundException $modelNotFoundException) {
            throw new InvalidCredentialsException($modelNotFoundException);
        } catch (UserNotFoundOnThisClientException $userNotFoundOnThisClientException) {
            throw new InvalidCredentialsException($userNotFoundOnThisClientException);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(['message' => 'Could Not Create Token'], 500);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
