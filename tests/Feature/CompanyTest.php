<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Traits\TestValidations;

class CompanyTest extends TestCase
{
    use DatabaseMigrations, TestValidations;

    public function testCreateNewCompany()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/companies', [
            "name" => "Company"
        ]);

        $response
            ->assertStatus(201)
            ->assertExactJson(["success" => "Company Created!"
            ]);
    }

    public function testCreateNewCompanyWithoutName()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/companies', []);

        $this->assertWithValidationRequired($response);
    }

    public function testGetCompanies()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->json('GET', '/api/v1/companies');

        $response->assertStatus(200);
    }

    public function testGetSingleCompany()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->json('GET', "/api/v1/companies/1");

        $response->assertStatus(200);
    }

    public function testCompanyNotFound()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}",
        ])->json('GET', "/api/v1/companies/10");

        $response
            ->assertStatus(404)
            ->assertExactJson([
                "error" => "Company Not Found."
            ]);
    }

    public function testGetCompaniesWithoutToken()
    {
        $response = $this->get('/api/v1/companies');

        $response
            ->assertStatus(401)
            ->assertExactJson([
                "error" => "Authorization Token not found."
            ]);
    }
}
