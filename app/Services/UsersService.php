<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsersService
 * @package App\Services
 */
class UsersService
{
    /**
     * @description Check if user is logged
     * @return bool
     */
    public static function checkUserLogged(): bool
    {
        if (Auth::check() == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @description Check if the user logged is admin
     * @return bool
     */
    public static function checkUserAdmin(): bool
    {
        if (Auth::check() == true && Auth::user()->user_admin == 1) {
            return true;
        }
        return false;
    }

    /**
     * @description Logout of system
     */
    public static function logout()
    {
        return Auth::logout();
    }

    public  static function getUserById($id)
    {
        try {
            $user = User::where('id', $id)->firstOrFail();

            return $user;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
}
