<?php


namespace App\Services;

use App\Models\User;

class UserService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function create($request)
    {
        return $this->user->create($request->only($this->user->getFillable()));
    }
}
