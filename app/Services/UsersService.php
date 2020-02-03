<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

/**
 * Class UsersService
 * @package App\Services
 */
class UsersService
{
    public function create(array $fields): User
    {
        $fields['password'] = Hash::make($fields['password']);
        $fields['token'] = Str::random(40);
        $fields['expires_token'] = Carbon::now()->addHours(1);

        return User::firstOrCreate($fields);
    }
}
