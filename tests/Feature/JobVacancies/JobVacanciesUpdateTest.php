<?php

namespace Tests\Feature\Product;

use App\Models\JobVacancies;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobVacanciesUpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withErrors();
        $this->signIn();
        $this->data = [
            'title' => 'vacancies dev pleno',
            'description' => 'job for dev',
            'status' => 'active',
            'workplace' => $this->faker->address,
            'salary' => $this->faker->randomFloat(2, 10, 999999)
        ];
    }

    /**
     * @test
     */
    public function should_return_status_code_200_and_job_vacancies_updated_when_params_is_valid()
    {
        $jobVacanciesId = JobVacancies::factory()->create()->id;

        $response = $this->put($this::BASE_URL . '/update' . "/$jobVacanciesId", $this->data);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function should_return_status_code_404_when_the_id_is_not_found()
    {
        $response = $this->put($this::BASE_URL . '/update' . '/1', $this->data);
        $response->assertStatus(404);
    }
}
