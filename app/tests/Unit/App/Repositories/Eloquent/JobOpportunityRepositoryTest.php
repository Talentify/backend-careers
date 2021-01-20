<?php

namespace Tests\Unit\App\Repositories\Eloquent;

use App\Models\Company;
use App\Models\JobOpportunity;
use App\Repositories\Eloquent\JobOpportunityRepository;
use Illuminate\Support\Collection;
use Laravel\Lumen\Testing\DatabaseTransactions;

class JobOpportunityRepositoryTest extends \TestCase
{
    use DatabaseTransactions;

    public function testIfJobOpportunityHasCreated(): void
    {
        $company = Company::factory()->create();
        $attributes = [
            'company_id'    =>  $company->id,
            'title'         =>  'Estágiario em TI',
            'description'   =>  'Venha ser Estagiário',
            'salary'        =>  1200.00,
            'status'        =>  'active',
            'workplace'     =>  'Av. Paulista, 1500',
        ];

        $jobOpportunityRepository = new JobOpportunityRepository(new JobOpportunity());
        $jobOpportunityRepository->create($attributes);

        $this->seeInDatabase('job_opportunities', [
            'company_id'    =>  $company->id,
            'title'         =>  'Estágiario em TI'
        ]);
    }

    public function testFindOneJobOpportunityById(): void
    {
        $company = Company::factory()->create();
        $jobOpportunity = JobOpportunity::factory()->create(['company_id'   =>  $company->id]);

        $jobOpportunityRepository = new JobOpportunityRepository(new JobOpportunity());
        $jobObject = $jobOpportunityRepository->findById($jobOpportunity->id);

        $this->assertInstanceOf(JobOpportunity::class, $jobObject);
    }

    public function testGetAllJobs(): void
    {
        $company = Company::factory()->create();
        $jobOpportunity = JobOpportunity::factory()
            ->times(4)
            ->create(['company_id'   =>  $company->id]);

        $jobOpportunityRepository = new JobOpportunityRepository(new JobOpportunity());
        $jobsOpportunities = $jobOpportunityRepository->all();

        $this->assertInstanceOf(Collection::class, $jobsOpportunities);
    }

    public function testUpdateJob(): void
    {
        $company = Company::factory()->create();
        $jobOpportunity = JobOpportunity::factory()
            ->create(['company_id'   =>  $company->id]);

        $attributes = [
            'title'         =>  'Estágiario em TI Junior',
            'description'   =>  'Venha ser Estagiário',
            'salary'        =>  1230.00,
            'status'        =>  'active',
        ];

        $jobOpportunityRepository = new JobOpportunityRepository(new JobOpportunity());
        $companyCollection = $jobOpportunityRepository->update($jobOpportunity->id, $attributes);

        $this->seeInDatabase('job_opportunities', [
            'company_id'    =>  $company->id,
            'title'         =>  'Estágiario em TI Junior',
            'description'   =>  'Venha ser Estagiário',
            'salary'        =>  1230.00,
            'status'        =>  'active',
        ]);
    }

    public function testDeleteCompany(): void
    {
        $company = Company::factory()->create();
        $jobOpportunity = JobOpportunity::factory()
            ->create(['company_id'   =>  $company->id]);

        $jobOpportunityRepository = new JobOpportunityRepository(new JobOpportunity());
        $companyCollection = $jobOpportunityRepository->delete($jobOpportunity->id);

        $this->notSeeInDatabase('job_opportunities', [
            'id'            =>  $jobOpportunity->id,
        ]);
    }
}
