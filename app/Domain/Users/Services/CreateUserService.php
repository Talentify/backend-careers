<?php

namespace App\Domain\Users\Services;

use Domain\Users\User;
use Illuminate\Support\Facades\DB;
use Infrastructure\Users\Repositories\Facades\RoleRepository;
use Infrastructure\Users\Repositories\Facades\UserRepository;

class CreateUserService
{
    public function __invoke(array $data)
    {
        $user = User::makeOwner($data, RoleRepository::findBySlug('owner'));

        try {
            DB::transaction(function () use ($user, &$res) {
                UserRepository::persist($user);
            });
        } catch (\Exception $e) {
            throw $e;
        }

        return $user;
    }
}
