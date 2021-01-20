<?php

namespace Tests\Unit\App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\JobOpportunityRepositoryInterface;
use App\Services\JobService;

class JobServiceTest extends \TestCase
{
    public function testCreateJob(): void
    {
        $jobService = new JobService(
            app(JobOpportunityRepositoryInterface::class),
            app(CompanyRepositoryInterface::class)
        );

        $company = Company::factory()->create();
        $attributes = [
            'company_id'    =>  $company->id,
            'workplace'     =>  'Av. Paulista',
            'description'   =>  'Teste',
            'title'         =>  'Vaga de Teste',
            'salary'        =>  12000.00,
            'status'        =>  'active'
        ];

        $jobObject = $jobService->createJob($attributes);

        $this->seeInDatabase('job_opportunities', ['id'  =>   $jobObject->id]);
    }
}
