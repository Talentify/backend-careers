<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InvalidLoginException;

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
        $fields['expires_token'] = Carbon::now()->addHours(2);

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
    
    /**
     * @param User $user
     * @param array $fields
     * @return User
     */
    public function update(User $user, array $fields): User
    {
        $user->name = $fields['name'] ?? $user->name;
        $user->email = $fields['email'] ?? $user->email;
        $user->password = (isset($fields['password'])) ? Hash::make($fields['password']) : $user->password;
        $user->expires_token = Carbon::now()->addHours(2);
        
        $user->save();
        
        return $user;
    }
    
    /**
     * @param array $fields
     * @return User
     */
    public function updateByAuthUser(array $fields): User
    {
        /**
         * @var User $user
         */
        $user = Auth::guard('user')->user();
        return $this->update($user, $fields);
    }
    
    /**
     * @return User
     */
    public function getAuthUser(): User
    {
        /**
         * @var User $user
         */
        $user = Auth::guard('user')->user();
        return $user;
    }
    
    /**
     * @param $email
     * @param $password
     * @return User
     * @throws InvalidLoginException
     */
    public function login($email, $password): User
    {
        $user = User::whereEmail($email)->first();
        $invalidHash = Hash::make("!{$password}");
        $userPassword = ($user instanceof User) ? $user->password : $invalidHash;
        if(!Hash::check($password, $userPassword)){
            throw new InvalidLoginException();
        }
    
        $user->api_token = Str::random(40);
        $user->expires_token = Carbon::now()->addHours(2);
        $user->save();
        return $user;
    }
}
