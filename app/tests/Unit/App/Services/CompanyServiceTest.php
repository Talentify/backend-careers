<?php

namespace Tests\Unit\App\Services;

use App\Exceptions\ExistsException;
use App\Models\Company;
use App\Models\JobOpportunity;
use App\Repositories\Eloquent\CompanyRepository;
use App\Repositories\Eloquent\JobOpportunityRepository;
use App\Services\CompanyService;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CompanyServiceTest extends \TestCase
{
    use DatabaseTransactions;

    public function testDeleteCompanyWithoutJobs(): void
    {
        $companyService = new CompanyService(
            app(JobOpportunityRepository::class),
            app(CompanyRepository::class)
        );

        $company = Company::factory()->create();

        $companyService->delete($company->id);

        $this->notSeeInDatabase('companies', ['id' =>  $company->id]);
    }

    public function testDeleteCompanyWithJobs(): void
    {
        $this->expectException(ExistsException::class);

        $companyService = new CompanyService(
            app(JobOpportunityRepository::class),
            app(CompanyRepository::class)
        );

        $company = Company::factory()->create();
        JobOpportunity::factory()->create(['company_id'  =>  $company->id]);

        $companyService->delete($company->id);
    }
}
