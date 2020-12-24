<?php

namespace App\Domain\Repository;

use App\Domain\User\Entity\User;

interface UserRepository
{
    public function save(User $user);
}