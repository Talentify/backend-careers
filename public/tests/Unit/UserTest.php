<?php

namespace Tests\Unit;

use App\User;

class UserTest
{
    /**
     * Check if user is an admin by email (login).
     *
     * @param string $email
     * @return bool
     */
    public function testIsAdmin(string $email)
    {
        $users = new User();
        $user = $users->where('email', $email)->where('type', 'admin')->get();

        return !isset($user->first()->email) ? '' : $user->first()->email;
    }

    /**
     * Check if user is a client by email (login).
     *
     * @param string $email
     * @return bool
     */
    public function testIsClient(string $email)
    {
        $users = new User();
        $user = $users->where('email', $email)->where('type', 'client')->get();

        return !isset($user->first()->email) ? '' : $user->first()->email;
    }

    /**
     * Check user's auth.
     *
     * @param $email
     * @param $password
     * @return bool
     */
    public function testHaveAuth(string $email, string $password)
    {
        $users = new User();
        $user = $users->where('email', $email)->where('password', $password)->get();

        return !isset($user->first()->email) ? '' : $user->first()->email;
    }
}
