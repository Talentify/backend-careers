<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Exceptions\InvalidLoginException;

class UserController
{
    public static function verifySession()
    {
        $logged = session('logged');
        if (!$logged) {
            header('Location: ./login');
            die();
        }
    }

    public static function signin(Request $request)
    {
        try {
            $email    = $request->email;
            $password = $request->pass;

            $user = (new User())->getByEmail($email);
            if (!$user) {
                throw new InvalidLoginException();
            }

            $valid = password_verify($password, $user['password']);
            if (!$valid) {
                throw new InvalidLoginException();
            }

            session(['logged' => true]);

            return response()->json(['status' => 'ok', 'user' => $user]);
        } catch (InvalidLoginException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()], 401);
        }
    }
}
