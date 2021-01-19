<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param  array  $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param  string  $id
     * @return Model|null
     */
    public function findById(string $id): ?Model;
}
