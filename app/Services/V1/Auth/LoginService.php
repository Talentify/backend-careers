<?php

declare(strict_types=1);

namespace App\Services\V1\Auth;

use App\Core\Http\Requests\Request;
use App\Core\Services\Service;
use App\Http\Requests\V1\Auth\Login;
use App\Models\V1\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\Token;

class LoginService extends Service
{
    /**
     * @param  Login  $request
     *
     * @return array
     * @throws AuthenticationException
     */
    public function login(Login $request)
    {
        $credentials = request(['email', 'password']);

        if (! Auth::attempt($credentials)) {
            throw new AuthenticationException(__('auth.failed'));
        }

        /** @var User $user */
        $user = $request->user();

        $tokenResult = $user->createToken('API Login');

        /** @var Token $token */
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return [
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
    }
}