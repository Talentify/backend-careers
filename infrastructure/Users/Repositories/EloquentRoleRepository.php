<?php

namespace Infrastructure\Users\Repositories;

use Domain\Users\Role;
use Infrastructure\Shared\Repositories\AbstractRepository;
use Infrastructure\Users\Repositories\Contracts\RoleRepositoryContract;

class EloquentRoleRepository extends AbstractRepository implements RoleRepositoryContract
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function findBySlug(string $slug): ?Role
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }
}
