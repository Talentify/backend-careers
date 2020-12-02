<?php

namespace App\Services;

use Hash;
use App\Models\User;

class UserService
{
    /**
     * Find the user by credentials
     *
     * @param  string $email
     * @param  string $password
     *
     * @return User|null
     */
    public function findByCredentials(string $email, string $password): ?User
    {
        $user = User::where('email', $email)->first();

        if (is_null($user) || !Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }

    /**
     * Create a new user
     *
     * @param  array  $attributes
     *
     * @return User
     */
    public function create(array $attributes): User
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        return User::create($attributes);
    }
}
