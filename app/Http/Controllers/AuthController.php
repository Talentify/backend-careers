<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function login(Request $request): JsonResponse
    {
        return response()->json($data = $this->authService->login($request), Arr::exists($data, 'msg') ? 401 : 200);
    }

    public function logout(): JsonResponse
    {
        return response()->json($this->authService->logout());
    }

    public function refreshToken(): JsonResponse
    {
        return response()->json($this->authService->refreshToken());
    }

    public function loggedUser(): JsonResponse
    {
        return response()->json($this->authService->loggedUser());
    }


}
