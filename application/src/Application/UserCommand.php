<?php

namespace App\Application;


use App\Domain\User\DTO\User;
use App\Domain\User\UserService;

class UserCommand
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(User $user)
    {
        $this->userService->create($user);
    }
}