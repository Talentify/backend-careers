<?php

namespace App\Services;

use App\Models\JobOpportunity;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\JobOpportunityRepositoryInterface;

class JobService
{
    protected $repository;
    protected $companyRepository;

    public function __construct(
        JobOpportunityRepositoryInterface $jobRepository,
        CompanyRepositoryInterface $companyRepository
    ) {
        $this->repository = $jobRepository;
        $this->companyRepository = $companyRepository;
    }

    public function createJob(array $attributes): JobOpportunity
    {
        if (!empty($attributes['company_id'])) {
            $this->companyRepository->findById($attributes['company_id']);
        }

        return $this->repository->create($attributes);
    }
}
