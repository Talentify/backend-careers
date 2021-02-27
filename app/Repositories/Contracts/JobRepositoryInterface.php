<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface JobRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data): Model;

    public function find(int $id): Model;

    public function destroy(int $id);

    public function update(int $id, array $data): Model;
}
