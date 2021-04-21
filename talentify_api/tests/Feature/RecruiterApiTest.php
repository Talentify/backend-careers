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

    public function test_should_login_recruiter_successfully()
    {   
        $headers = ['Accept' => 'application/json'];
        
        $idCompany = 1;
        $companyName = "Microsoft";
        $login = "testerlogin";
        $senha = "senha123";

        Recruiter::factory()->create([
            'id_company' => $idCompany,
            'name' => $companyName,
            'login' => $login,
            'password' => bcrypt($senha)
        ]);
        
        $formLoginData = [
            'login' => $login,
            'password' => $senha
        ];
        
        $response = $this->post('/api/login', $formLoginData, $headers);
        $response->assertStatus(200);
        $response->assertJsonFragment(['login' => $login]);  
        $response->assertJsonFragment(['message' => 'Recruiter logged in successfully!']);   
        $response->assertJsonStructure([ 
            'success',
            'message',
            'data'    => [
                'user',
                'token'
            ],
        ]);   
    }

    public function test_should_not_login_with_wrong_credentials()
    {   
        $headers = ['Accept' => 'application/json'];
        
        $idCompany = 1;
        $companyName = "Microsoft";
        $login = "testerlogin";
        $senha = "senha123";

        $loggedInUser = Recruiter::factory()->create([
            'id_company' => $idCompany,
            'name' => $companyName,
            'login' => $login,
            'password' => bcrypt($senha)
        ]);
        
        $aWrongLoginData = "testerWronglogin";
        $formLoginData = [
            'login' => $aWrongLoginData,
            'password' => $senha
        ];
        
        $response = $this->post('/api/login', $formLoginData, $headers);
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => 'Incorrect credentials!']);   
        $response->assertJsonStructure([ 
            'success',
            'message'            
        ]);   
    } 
    
    public function test_should_logout_successfully()
    {   
        $headers = ['Accept' => 'application/json'];
        
        $idCompany = 1;
        $companyName = "Microsoft";
        $login = "testerlogin";
        $senha = "senha123";

        $loggedInUser = Recruiter::factory()->create([
            'id_company' => $idCompany,
            'name' => $companyName,
            'login' => $login,
            'password' => bcrypt($senha)
        ]);
        
        $formLoginData = [
            'login' => $login,
            'password' => $senha
        ];
        
        $response = $this->post('/api/login', $formLoginData, $headers);
        $response->assertStatus(200);
        $response->assertJsonFragment(['login' => $login]);  
        $response->assertJsonFragment(['message' => 'Recruiter logged in successfully!']);   
        $response->assertJsonStructure([ 
            'success',
            'message',
            'data'    => [
                'user',
                'token'
            ],
        ]);
        
        Sanctum::actingAs($loggedInUser); 
        $logoutResponse = $this->post('/api/logout', [], $headers);
        $logoutResponse->assertStatus(200);
        $logoutResponse->assertJsonFragment(['message' => 'User: '.$login.' disconnected!']);   
    }
    
}
