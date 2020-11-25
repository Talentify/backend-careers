<?php

namespace Infrastructure\Users\Repositories\Contracts;

use Domain\Users\User;

interface UserRepositoryContract
{
    public function findByEmail(string $email): ?User;
}
