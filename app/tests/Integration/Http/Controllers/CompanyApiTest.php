<?php

namespace Tests\Integration\App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CompanyApiTest extends \TestCase
{
    use DatabaseTransactions;

    public function testIfCanCreateCompany(): void
    {
        $user = User::factory()->create();

        $data = [
            'name'          => 'Talentify',
            'description'   =>  'First Company Of This API',
            'size'          =>  'small',
        ];

        $this->actingAs($user)
            ->post('/api/v1/companies', $data)
            ->seeJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'size',
                        'description'
                    ]
                ]
            );
    }

    public function testIfCanUpdateCompany(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $data = [
            'name'          =>  'Pfannerstill-Bogisich',
	        'description'   =>  'Teste 2',
	        'size'          =>  'small',
        ];

        $this->actingAs($user)
            ->put('/api/v1/companies/' . $company->id, $data)
            ->seeJsonEquals(
                [
                    'data' => [
                        'id'            =>  $company->id,
                        'name'          =>  'Pfannerstill-Bogisich',
                        'size'          =>  'small',
                        'description'   =>  'Teste 2'
                    ]
                ]
            );
    }

    public function testIfCanDeleteCompany(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $this->actingAs($user)
            ->delete('/api/v1/companies/' . $company->id)
            ->seeStatusCode(204);
    }

    public function testIfCanViewCompany(): void
    {
        $company = Company::factory()->create();
        $this->get('/api/v1/companies/' . $company->id)
            ->seeStatusCode(200)
            ->seeJsonStructure(
                [
                    'data'  =>  [
                        'id',
                        'name',
                        'size',
                        'description'
                    ]
                ]
            );
    }

    public function testIfCanListAllCompany(): void
    {
        $company = Company::factory()->create();

        $this->get('/api/v1/companies/')
            ->seeStatusCode(200);
    }
}
