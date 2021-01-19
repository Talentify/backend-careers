<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function findById(string $companyId): Model
    {
        $company = $this->model->find($companyId);

        if (!$company) {
            throw new NotFoundHttpException("Company Not Found");
        }

        return $company;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->all($columns);
    }

    public function update(string $companyId, array $attributes): Model
    {
        $company = $this->findById($companyId);

        $company->update($attributes);
        return $company;
    }

    public function delete(string $companyId): void
    {
        $company = $this->findById($companyId);

        $company->delete();
    }
}
