<?php

namespace Tests\Feature\Product;

use App\Models\JobVacancies;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobVacanciesShowTest extends TestCase
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
    public function should_return_status_code_200_and_job_vacancies_by_id()
    {
        $jobVacanciesId =  JobVacancies::factory()->create()->id;

        $response = $this->get($this::BASE_URL.'/show'."/$jobVacanciesId");

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function should_return_status_code_404_when_the_id_not_found()
    {
        $response = $this->get($this::BASE_URL.'/show'.'/1');

        $response->assertStatus(404);
    }
}
