<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;

interface UserRepository
{
    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param User $user
     */
    public function delete(User $user): void;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param array $filters
     * @return array
     */
    public function findBy(array $filters = []): array;

    /**
     * @param User $user
     * @return User
     */
    public function update(User $user): User;
}
