<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function register(Request $request)
    {
        try {
            $validator = $this->validateRegister($request);

            if (!$validator['success']) {
                return $validator;
            }
            $user = $this->repository->create($request->all());
            return [
                'success' => true,
                'message' => 'User created.',
                'data' => $user
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function login(Request $request)
    {
        try {
            $result = Helper::validatePayload($request);

            if (!$result['success']) {
                return $result;
            }
            $validator = Validator::make($request->all(), UserValidator::RULE_LOGIN);

            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => $validator->errors(),
                ];
            }
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return [
                    'success' => false,
                    'message' => 'Access denied.',
                ];
            }
            $token = $request->user()->createToken('access-token')->accessToken;

            return [
                'success' => true,
                'token' => $token,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return [
            'success' => true,
            'message' => 'Logged out successfully.',
        ];
    }

    public function validateRegister(Request $request)
    {
        $result = Helper::validatePayload($request);

        if (!$result['success']) {
            return $result;
        }
        $validator = Validator::make($request->all(), UserValidator::RULE_REGISTER);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator->errors(),
            ];
        }
        return [
            'success' => true,
            'message' => '',
        ];
    }
}
