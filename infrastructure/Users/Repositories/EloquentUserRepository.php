<?php

namespace Infrastructure\Users\Repositories;

use Domain\Users\Role;
use Domain\Users\User;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Shared\Repositories\AbstractRepository;
use Infrastructure\Users\Repositories\Contracts\UserRepositoryContract;

class EloquentUserRepository extends AbstractRepository implements UserRepositoryContract
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->firstOrFail();
    }

    public function persist(Model $model): Model
    {
        parent::persist($model);

        if ($model->roles !== null && $model->roles->isNotEmpty()) {
            $model->roles->map(function (Role $role) use ($model) {
                $model->roles()->save($role);
            });
        }

        return $model;
    }
}
