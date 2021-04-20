<?php

namespace Tests\Feature;

use App\Models\Recruiter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class CompanyApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_create_company()
    {
        Sanctum::actingAs(
            Recruiter::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/companies');
        $response->assertStatus(201);
        
        /*
        $formData = [
            'name' => 'Microsoft'
        ];

        this->json('POST', route('companies.store'), $formData)
        ->assertStatus(201);
        */
    }

    public function test_task_list_can_be_retrieved()
    {
        Sanctum::actingAs(
            Recruiter::factory()->create(),
            ['*']
        );
        
        $response = $this->get('/api/companies');        
        $response->assertOk();
    }    
}
