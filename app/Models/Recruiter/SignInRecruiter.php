<?php


namespace App\Models\Recruiter;


use App\Models\Recruiter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SignInRecruiter
{
    public static function signIn(Request $request): Recruiter
    {
        try {
            $recruiter = Recruiter::where('login', $request->login)->firstOrFail();
            $password = $recruiter->password;
        } catch (ModelNotFoundException $e) {
            $password = '';
        }

        if (!self::validateLogin($request->password, $password)) {
            throw new \Exception('Invalid credential');
        }

        return $recruiter;
    }

    private static function validateLogin(string $requestPass, string $pass): bool
    {
        if (!password_verify($requestPass, $pass)) {
            return false;
        }

        return true;
    }

}