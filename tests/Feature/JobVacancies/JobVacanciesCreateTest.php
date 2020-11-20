<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobVacanciesCreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withErrors();
        $this->signIn();
    }

    /**
     * @test
     */
    public function should_return_status_code_201_and_job_vacancies_created_when_params_is_valid()
    {
        $data = [
            'title' => 'vacancies dev pleno',
            'description' => 'job for dev',
            'status' => 'active',
            'workplace' => $this->faker->address,
            'salary' => $this->faker->randomFloat(2, 10, 999999)
        ];

        $response = $this->post($this::BASE_URL . '/create', $data);
        $response->assertStatus(201);
    }

    /**
     * @test
     * @dataProvider providerError
     */
    public function should_return_status_code_422($data, $inputErro)
    {
        $response = $this->post($this::BASE_URL .'/create', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors($inputErro);
    }

    public function providerError()
    {
        $this->refreshApplication();

        return [
            'when description is blank' => [
                'data' => [
                    'title' => 'vacancies dev dull',
                    'description' => '',
                    'status' => 'active',
                    'workplace' => 'rua teste',
                    'salary' => '80000.00'
                ],
                'inputErro' => 'description'
            ],
            'when title is blank' => [
                'data' => [
                    'title' => '',
                    'description' => 'dev full',
                    'status' => 'active',
                    'workplace' => 'rua teste',
                    'salary' => '80000.00'
                ],
                'inputErro' => 'title'
            ],
            'when status is blank' => [
                'data' => [
                    'title' => 'vacancies dev full',
                    'description' => 'dev full',
                    'status' => '',
                    'workplace' => 'rua teste',
                    'salary' => '80000.00'
                ],
                'inputErro' => 'status'
            ],
        ];
    }
}
