<?php

namespace Infrastructure\Jobs\Repositories;

use Domain\Jobs\Job;
use Domain\Jobs\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Infrastructure\Jobs\Repositories\Contracts\JobRepositoryContract;
use Infrastructure\Shared\Repositories\AbstractRepository;

class EloquentJobRepository extends AbstractRepository implements JobRepositoryContract
{
    public function __construct(Job $job)
    {
        $this->model = $job;
    }

    public function persist(Model $model): Model
    {
        if ($model->address !== null) {
            $model->address->save();
        }

        return parent::persist($model);
    }

    public function findActiveJobs(): ?Collection
    {
        return $this->model->where('status', Status::ACTIVE)->get();
    }
}
