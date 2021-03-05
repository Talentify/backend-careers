<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Util\TestsHelper;

class JobTest extends TestCase
{
    use RefreshDatabase;

    protected $recruiter;
    protected $recruiterToken;

    protected function setUp(): void
    {
        parent::setUp();
        $this->recruiter = TestsHelper::createRecruiterWithFactory();
        $response = $this->post('/api/recruiters/login', [
            'email' => $this->recruiter->email,
            'password' => 'password',
        ]);
        $this->recruiterToken = $response->json()['data']['token'];
    }


    /**
     * Create a new recruiter.
     *
     * @return void
     */
    public function testCreateJob()
    {
        $data = [
            'title' => 'Desenvolvedor PHP Sênior',
            'description' => 'Aqui tem uma descrição bem descolada!',
            'status' => 'active',
            'address' => "Av. Paulista, N 1121",
            'salary' => '13000',
        ];

        $response = $this->post('/api/jobs', $data, [
            'Authorization' => 'Bearer ' . $this->recruiterToken,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('jobs', [
            'id' => $response->json()['data']['job']['id'],
            'recruiter_id' => $this->recruiter->id,
            'company_id' => $this->recruiter->company_id,
        ]);
    }

    public function testEditJob()
    {
        $job = TestsHelper::createJobWithFactory($this->recruiter);

        $response = $this->put('/api/jobs/' . $job->id, [
            'title' => 'Vaga Editada',
        ], [
            'Authorization' => 'Bearer ' . $this->recruiterToken,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'title' => 'Vaga Editada',
        ]);
    }

    public function testSearchByCompany()
    {
        $job = TestsHelper::createJobWithFactory($this->recruiter, ['company_id' => 999]);

        $response = $this->post('/api/jobs/search', [
            'company_id' => 999,
        ]);

        $response->assertJson([
            'data' => [
                'jobs' => [[
                    'id' => $job->id,
                    'company_id' => 999,
                ]],
            ],
        ]);
    }

    public function testSearchBySalary()
    {
        $job = TestsHelper::createJobWithFactory($this->recruiter, ['salary' => 5123]);

        $response = $this->post('/api/jobs/search', [
            'salary' => 5123,
        ]);

        $response->assertJson([
            'data' => [
                'jobs' => [[
                    'id' => $job->id,
                    'salary' => 5123,
                ]],
            ],
        ]);
    }

    public function testSearchByAddress()
    {
        $job = TestsHelper::createJobWithFactory($this->recruiter);

        $response = $this->post('/api/jobs/search', [
            'address' => $job->address,
        ]);

        $response->assertJson([
            'data' => [
                'jobs' => [[
                    'id' => $job->id,
                    'address' => $job->address,
                ]],
            ],
        ]);
    }

    public function testSearchByKeywords()
    {
        $job = TestsHelper::createJobWithFactory($this->recruiter, [
            'description' => 'PHP, MySQL e Jquery'
        ]);

        $response = $this->post('/api/jobs/search', [
            'keywords' => 'php,jquery',
        ]);

        $response->assertJson([
            'data' => [
                'jobs' => [[
                    'id' => $job->id,
                    'description' => 'PHP, MySQL e Jquery',
                ]],
            ],
        ]);
    }
}
