<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InvalidLoginException;

/**
 * Class AdminsService
 * @package App\Services
 */
class AdminsService
{
    /**
     * @param array $fields
     * @return Admin
     */
    public function create(array $fields): Admin
    {
        $fields['password'] = Hash::make($fields['password']);
        $fields['api_token'] = Str::random(40);
        $fields['expires_token'] = Carbon::now()->addHours(2);

        return Admin::firstOrCreate($fields);
    }
    
    /**
     * @param Admin $admin
     * @param array $fields
     * @return Admin
     */
    public function update(Admin $admin, array $fields): Admin
    {
        $admin->name = $fields['name'] ?? $admin->name;
        $admin->email = $fields['email'] ?? $admin->email;
        $admin->password = (isset($fields['password'])) ? Hash::make($fields['password']) : $admin->password;
        $admin->expires_token = Carbon::now()->addHours(2);
        
        $admin->save();
        
        return $admin;
    }
    
    /**
     * @param array $fields
     * @return Admin
     */
    public function updateByAuthAdmin(array $fields): Admin
    {
        /**
         * @var Admin $admin
         */
        $admin = $this->getAuthAdmin();
        return $this->update($admin, $fields);
    }
    
    /**
     * @return Admin
     */
    public function getAuthAdmin(): Admin
    {
        /**
         * @var Admin $admin
         */
        $admin = Auth::guard('admin')->user();
        return $admin;
    }
    
    /**
     * @param $email
     * @param $password
     * @return Admin
     * @throws InvalidLoginException
     */
    public function login($email, $password): Admin
    {
        $admin = Admin::whereEmail($email)->first();
        $invalidHash = Hash::make("!{$password}");
        $adminPassword = ($admin instanceof Admin) ? $admin->password : $invalidHash;
        if(!Hash::check($password, $adminPassword)){
            throw new InvalidLoginException();
        }
    
        $admin->api_token = Str::random(40);
        $admin->expires_token = Carbon::now()->addHours(2);
        $admin->save();
        return $admin;
    }
}
