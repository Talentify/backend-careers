<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * After login redirect to dashbord.
     */
    const AFTER_LOGIN_REDIRECT_TO = 'dashboard';

    /**
     * After logout redirect to login screen.
     */
    const AFTER_LOGOUT_REDIRECT_TO = 'login';

    /**
     * Validate login request.
     *
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $validate = [
            'email' => 'required|string',
            'password' => 'required|string'
        ];
        $request->validate($validate);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request)
    {
        $this->validateLogin($request);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(self::AFTER_LOGIN_REDIRECT_TO);
        }
        return back()->with('error', __('Email or Password is invalid!'));
    }


    /**
     * Logout.
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->intended(self::AFTER_LOGOUT_REDIRECT_TO);
    }
}

