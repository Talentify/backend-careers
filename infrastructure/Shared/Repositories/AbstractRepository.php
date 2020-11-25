<?php

namespace Infrastructure\Shared\Repositories;

use Illuminate\Database\Eloquent\Model;
use Infrastructure\Shared\Repositories\Contracts\AbstractContract;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractRepository implements AbstractContract
{
    protected Model $model;

    public function findAll(): Collection
    {
        return $this->model->all();
    }

    public function findById(string $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function persist(Model $model): Model
    {
        $model->save();
        return $model;
    }
}
