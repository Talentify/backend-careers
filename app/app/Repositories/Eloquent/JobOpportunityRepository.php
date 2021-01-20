<?php

namespace App\Repositories\Eloquent;

use App\Enums\JobStatus;
use App\Models\JobOpportunity;
use App\Repositories\JobOpportunityRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class JobOpportunityRepository extends BaseRepository implements JobOpportunityRepositoryInterface
{
    public function __construct(JobOpportunity $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function all(array $columns = []): Collection
    {
        return $this->model->where('status', JobStatus::ACTIVE);
    }

    public function update(string $id, array $attributes): Model
    {
        $job = $this->findById($id);
        $job->update($attributes);
        return $job;
    }

    public function delete(string $id): bool
    {
        $job = $this->findById($id);
        return $job->delete();
    }

    public function findByCompanyId(string $companyId): Collection
    {
        return $this->model->where('company_id', $companyId)
            ->where('status', JobStatus::ACTIVE)
            ->get();
    }
}
