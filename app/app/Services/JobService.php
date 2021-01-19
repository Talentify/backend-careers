<?php

namespace App\Services;

use App\Models\Jobs;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\JobRepositoryInterface;

class JobService
{
    protected $repository;
    protected $companyRepository;

    public function __construct(
        JobRepositoryInterface $jobRepository,
        CompanyRepositoryInterface $companyRepository
    ) {
        $this->repository = $jobRepository;
        $this->companyRepository = $companyRepository;
    }

    public function createJob(array $attributes): Jobs
    {
        if (!empty($attributes['company_id'])) {
            $this->companyRepository->findById($attributes['company_id']);
        }

        return $this->repository->create($attributes);
    }

    public function updateJob(string $jobId, array $attributes): Jobs
    {
        return $this->repository->update($jobId, $attributes);
    }
}
