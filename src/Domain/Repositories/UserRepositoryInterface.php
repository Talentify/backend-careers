<?php

namespace App\Domain\Repositories;

use App\Domain\Entity\User;
use App\Domain\ValuesObjects\UserList;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User;

    /**
     * @return UserList|null
     */
    public function index(): ?UserList;

    /**
     * @param array $data
     * @return User|null
     */
    public function create(array $data) : ?User;
}