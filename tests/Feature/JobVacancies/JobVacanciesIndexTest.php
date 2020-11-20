<?php

namespace Tests\Feature\Product;

use App\Models\JobVacancies;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobVacanciesIndexTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->withErrors();
        $this->signIn();
    }

    /**
     * @test
     */
    public function should_return_status_code_200_and_job_vacancies_paginate()
    {
        JobVacancies::factory()->count(30)->create();

        $response = $this->get($this::BASE_URL.'/index');

        $response->assertStatus(200);
    }
}
