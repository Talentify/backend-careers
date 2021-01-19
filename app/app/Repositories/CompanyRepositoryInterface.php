<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CompanyRepositoryInterface
{
    public function all(array $columns = []): Collection;

    public function create(array $attributes): Model;

    public function findById(string $id): ?Model;

    public function update(string $companyId, array $attributes): Model;

    public function delete(string $companyId): void;
}
