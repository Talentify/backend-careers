<?php

namespace Infrastructure\Shared\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AbstractContract
{
    public function findAll(): Collection;

    public function findById(string $id): ?Model;

    public function persist(Model $model): Model;
}

