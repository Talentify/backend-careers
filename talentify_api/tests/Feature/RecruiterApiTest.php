<?php

namespace Tests\Feature;

use App\Models\Recruiter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class RecruiterApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_should_register_new_recruiter_successfully()
    {   
        Sanctum::actingAs(Recruiter::factory()->create());      

        $headers = ['Accept' => 'application/json'];
        
        $idCompany = 1;
        $companyName = "Microsoft";
        $login = "testerlogin";
        $senha = "senha";
        
        $formData = [
            'id_company' => $idCompany,
            'name' => $companyName,
            'login' => $login,
            'password' => $senha
        ];

        $response = $this->post('/api/register', $formData, $headers);
        $response->assertStatus(201);
    }
    
}
