<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(Request $request)
    {
        $result = $this->service->register($request);

        if ($result['success']) {
            return new UserResource($result['data']);
        } else {
            return response()->json(['error' => $result['message']], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function login(Request $request)
    {
        $result = $this->service->login($request);

        if ($result['success']) {
            return response()->json(['token' => $result['token']], Response::HTTP_OK);
        } else {
            return response()->json(['error' => $result['message']], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function logout(Request $request)
    {
        $result = $this->service->logout($request);

        if ($result['success']) {
            return response()->json(['message' => $result['message']], Response::HTTP_OK);
        } else {
            return response()->json(['error' => $result['message']], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
