<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Core\Http\Controllers\Controller;
use App\Core\Http\Requests\Request;
use App\Http\Requests\V1\Auth\Login;
use App\Services\V1\Auth\LoginService;

/**
 * Class LoginController
 *
 * @package App\Http\Controllers\V1\Auth
 */
class LoginController extends Controller
{
    public LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(Login $request)
    {
        $token = $this->loginService->login($request);

        return response()->success($token);
    }

    public function logout(Request $request)
    {
        $this->loginService->logout($request);

        return response()->success(__('auth.logout'));
    }
}
