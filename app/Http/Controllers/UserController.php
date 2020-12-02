<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\CreateUserRequest;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Returns the user api_token for authenticated requests
     *
     * @param  LoginUserRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $user = $this->userService->findByCredentials(
            $request->email,
            $request->password
        );

        if (!is_null($user)) {
            return $this->apiResponse(
                __('controllers/user.user_successfully_authenticated'),
                ['api_token' => $user->api_token]
            );
        }

        return $this->apiResponse(
            __('controllers/user.email_or_password_incorrect'),
            null,
            401
        );
    }

    /**
     * Store a new User
     *
     * @param  CreateUserRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = $this->userService->create($request->all());

        if (!is_null($user)) {
            return $this->apiResponse(
                __('controllers/user.user_created_successfully'),
                $user
            );
        }

        return $this->apiResponse(__('controllers/user.failed_to_create_user'));
    }
}
