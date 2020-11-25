<?php

namespace Infrastructure\Users\Repositories\Contracts;

use Domain\Users\Role;

interface RoleRepositoryContract
{
    public function findBySlug(string $slug): ?Role;
}
