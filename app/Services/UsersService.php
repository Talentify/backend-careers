<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsersService
 * @package App\Services
 */
class UsersService
{
    /**
     * @param array $fields
     * @return User
     */
    public function create(array $fields): User
    {
        $fields['password'] = Hash::make($fields['password']);
        $fields['api_token'] = Str::random(40);
        $fields['expires_token'] = Carbon::now()->addHours(1);

        return User::firstOrCreate($fields);
    }

    /**
     * @param string $apiToken
     * @param int $jobId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(int $jobId)
    {
        /**
         * @var User $user
         */
        $user = Auth::guard('user')->user();
        $user->jobs()->syncWithoutDetaching([$jobId]);
        return $user->with('jobs')->first();
    }
}
