<?php

namespace Tests\Feature;

use App\Models\Recruiter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class CompanyApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_get_all_companies()
    {   
        Sanctum::actingAs(Recruiter::factory()->create());        
        $response = $this->get('/api/companies');
        $response->assertStatus(200);        
    }
        
}
