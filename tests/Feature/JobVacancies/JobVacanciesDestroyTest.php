<?php

namespace Tests\Feature\Product;

use App\Models\JobVacancies;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobVacanciesDestroyTest extends TestCase
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
    public function should_return_status_code_204_when_job_vacancies_is_deleted()
    {
        $jobVacanciesId =  JobVacancies::factory()->create()->id;

        $response = $this->delete($this::BASE_URL.'/delete'."/$jobVacanciesId");

        $response->assertStatus(204);
    }

    /**
     * @test
     */
    public function should_return_status_code_404_when_the_id_not_found()
    {
        $response = $this->delete($this::BASE_URL.'/delete/1');

        $response->assertStatus(404);
    }
}
