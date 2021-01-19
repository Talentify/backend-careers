<?php

namespace App\Services;

use App\Exceptions\ExistsException;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\JobRepositoryInterface;

class CompanyService
{
    protected $companyRepository;
    protected $jobRepository;

    public function __construct(
        JobRepositoryInterface $jobRepository,
        CompanyRepositoryInterface $companyRepository
    ) {
        $this->companyRepository = $companyRepository;
        $this->jobRepository = $jobRepository;
    }

    public function delete(string $companyId): bool
    {
        $jobs = $this->jobRepository->findByCompanyId($companyId);

        if ($jobs->count() > 0) {
            throw new ExistsException("Company Has One Or More Jobs Active");
        }

        $company = $this->companyRepository->findById($companyId);
        return $company->delete();

    }

}
