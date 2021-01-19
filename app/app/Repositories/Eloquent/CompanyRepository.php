<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function findById(string $companyId): Model
    {
        return $this->model->find($companyId);
    }

    public function all(array $columns = []): Collection
    {
        // TODO: Implement all() method.
    }
}
