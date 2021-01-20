<?php

namespace Tests\Integration\App\Http\Controllers;

use App\Models\Company;
use App\Models\JobOpportunity;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseTransactions;

class JobsApiTest extends \TestCase
{
    use DatabaseTransactions;

    public function testIfCanCreateJob(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $data = [
            'company_id'    => $company->id,
            'workplace'     =>  'Av. Paulista, 1290 10º andar',
            'title'         =>  'Pessoa Desenvolvedora Back-End',
            'description'   =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'salary'        =>  12000.00,
            'status'        =>  'active'
        ];

        $this->actingAs($user)
            ->post('/api/v1/jobs', $data)
            ->seeStatusCode(201)
            ->seeJsonStructure(
                [
                    'data' => [
                        'id',
                        'company' => [
                            'id',
                            'name',
                            'size',
                            'description'
                        ],
                        'workplace',
                        'title',
                        'description',
                        'salary',
                        'status'
                    ]
                ]
            );
    }

    public function testIfCanUpdateCompany(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $job = JobOpportunity::factory()->create(
            [
                'company_id'    =>  $company->id
            ]
        );

        $data = [
            'title'         => 'Pessoa Desenvolvedora Front-End',
	        'description'   => 'Desenvolvedor(a) Front-End',
            'salary'        =>  12000.00,
            'status'        => 'active'
        ];

        $this->actingAs($user)
            ->put('/api/v1/jobs/' . $job->id, $data)
            ->seeStatusCode(200)
            ->seeJsonStructure(
                [
                    'data' => [
                        'id',
                        'company' => [
                            'id',
                            'name',
                            'size',
                            'description'
                        ],
                        'workplace',
                        'title',
                        'description',
                        'salary',
                        'status'
                    ]
                ]
            );
    }

    public function testIfCanDeleteJob(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $job = JobOpportunity::factory()->create(
            [
                'company_id'    =>  $company->id
            ]
        );

        $this->actingAs($user)
            ->delete('/api/v1/jobs/' . $job->id)
            ->seeStatusCode(204);
    }

    public function testIfCanViewJob(): void
    {
        $company = Company::factory()->create();
        $job = JobOpportunity::factory()->create(
            [
                'company_id'    =>  $company->id
            ]
        );

        $this->get('/api/v1/jobs/' . $job->id)
            ->seeStatusCode(200)
            ->seeJsonStructure(
                [
                    'data' => [
                        'id',
                        'company' => [
                            'id',
                            'name',
                            'size',
                            'description'
                        ],
                        'workplace',
                        'title',
                        'description',
                        'salary',
                        'status'
                    ]
                ]
            );
    }

    public function testIfCanListAllJobs(): void
    {
        $company = Company::factory()->create();
        JobOpportunity::factory()->create(
            [
                'company_id'    =>  $company->id
            ]
        );

        $this->get('/api/v1/jobs/')
            ->seeStatusCode(200);
    }
}
