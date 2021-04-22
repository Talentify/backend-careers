<?php

namespace Tests\Feature;

use App\Models\Recruiter;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        Company::factory()->create([
            'name' => 'The First Company'
        ]);

        Company::factory()->create([
            'name' => 'The Second Company'
        ]);

        Company::factory()->create([
            'name' => 'The Third Company'
        ]);
        
        $response = $this->get('/api/companies');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJsonFragment(['name' => 'The First Company']);      
        $response->assertJsonFragment(['name' => 'The Second Company']);      
        $response->assertJsonFragment(['name' => 'The Third Company']);      
    }

    public function test_should_show_specific_company()
    {      
        Sanctum::actingAs(Recruiter::factory()->create());  

        $company1 = Company::factory()->create([
            'name' => 'Some specific company'
        ]);

        $company2 = Company::factory()->create([
            'name' => 'The Second Company'
        ]);

        $company3 = Company::factory()->create([
            'name' => 'The Third Company'
        ]);
        
        $response = $this->get('/api/companies/'.$company2->id);
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['name' => 'The Second Company']);  
        $response->assertJsonMissing(['name' => 'Some specific company']);  
        $response->assertJsonMissing(['name' => 'The Third Company']);  
    }

    public function test_should_create_a_company()
    {      
        Sanctum::actingAs(Recruiter::factory()->create());  

        $headers = ['Accept' => 'application/json'];
        
        $formData = [
            'name' => 'The First Company'
        ];

        $response = $this->post('/api/companies', $formData, $headers);
        $response->assertStatus(201);        
        $response->assertJsonFragment(['name' => 'The First Company']);      
    }
        
}
