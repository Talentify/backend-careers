<?php

namespace Tests\Unit\App\Repositories\Eloquent;

use App\Models\Company;
use App\Models\JobOpportunity;
use App\Repositories\Eloquent\CompanyRepository;
use Illuminate\Support\Collection;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CompanyRepositoryTest extends \TestCase
{
    use DatabaseTransactions;

    public function testIfCompanyHasCreated(): void
    {
        $attributes = [
            'name'          =>  'Company 01',
            'description'   =>  'Company Test',
            'size'          =>  'large',
        ];

        $companyRepository = new CompanyRepository(new Company());
        $companyRepository->create($attributes);

        $this->seeInDatabase('companies', [
             'name' =>  'Company 01'
        ]);
    }

    public function testFindOneCompanyById(): void
    {
        $company = Company::factory()->create();

        $companyRepository = new CompanyRepository(new Company());
        $companyObject = $companyRepository->findById($company->id);

        $this->assertInstanceOf(Company::class, $companyObject);
    }

    public function testGetAllCompany(): void
    {
        $company = Company::factory()->times(4)->create();

        $companyRepository = new CompanyRepository(new Company());
        $companyCollection = $companyRepository->all();

        $this->assertInstanceOf(Collection::class, $companyCollection);
    }

    public function testUpdateCompany(): void
    {
        $company = Company::factory()->create();

        $attributes = [
            'name'          =>  'Company 055',
            'description'   =>  'Company Test 055',
            'size'          =>  'small',
        ];

        $companyRepository = new CompanyRepository(new Company());
        $companyCollection = $companyRepository->update($company->id, $attributes);

        $this->seeInDatabase('companies', [
            'id'            =>  $company->id,
            'name'          =>  $attributes['name'],
            'description'   =>  $attributes['description'],
            'size'          =>  $attributes['size'],
        ]);
    }

    public function testDeleteCompany(): void
    {
        $company = Company::factory()->create();

        $companyRepository = new CompanyRepository(new Company());
        $companyCollection = $companyRepository->delete($company->id);

        $this->notSeeInDatabase('companies', [
            'id'            =>  $company->id,
        ]);
    }
}
