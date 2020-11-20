<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository extends Repository
{

    public function __construct(Job $model)
    {
        parent::__construct($model);
    }

    public function getAllAvailable()
    {
        return $this->model->where('status', Job::STATUS_ACTIVE)->get();
    }

}
