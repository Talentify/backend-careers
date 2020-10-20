<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Exception;
use http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;

class LoginController extends Controller
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(Logger $logger, AuthService $authService)
    {
        $this->logger      = $logger;
        $this->authService = $authService;
    }

    /**
     * @param Request $request
     * @return array|JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $credentials = current($request->all());
            return $this->authService->login($credentials);
        } catch (Exception $ex) {
            return response()->json([], 401);
        }
    }
}
