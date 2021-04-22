<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Traits\TestValidations;

class RecruiterTest extends TestCase
{
    use TestValidations, DatabaseMigrations;

    public function testCreateNewRecruiter()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/recruiters', [
            "name" => "Recruiter Test",
            "email" => "foo@email.com",
            "password" => "secret",
            "company_id" => 2
        ]);

        $response
            ->assertStatus(201)
            ->assertExactJson(["success" => "Recruiter Created!"
            ]);
    }

    public function testGetRecruiters()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->json('GET', '/api/v1/recruiters');

        $response->assertStatus(200);
    }

    public function testShowRecruiter()
    {
        $recruiter = $this->createRecruiter();
        $token = $recruiter['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->json('GET', "/api/v1/recruiters/1");

        $response->assertStatus(200);
    }

    public function testRecruiterNotFound()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}",
        ])->json('GET', "/api/v1/recruiters/10");

        $response
            ->assertStatus(404)
            ->assertExactJson([
                "error" => "Recruiter Not Found."
            ]);
    }

    public function testGetRecruitersWithoutToken()
    {
        $response = $this->get('/api/v1/recruiters');

        $response
            ->assertStatus(401)
            ->assertExactJson([
                "error" => "Authorization Token not found."
            ]);
    }

    public function testStoreWithRequiredFields()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/recruiters', [
            'name' => '',
            'email' => '',
            'password' =>'',
            'company_id' => ''
        ]);

        $this->assertInvalidationFields($response, ['name'], 'required', []);
        $this->assertInvalidationFields($response, ['email'], 'required', []);
        $this->assertInvalidationFields($response, ['password'], 'required', []);
        $this->assertInvalidationFields($response, ['company_id'], 'required', []);

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/recruiters', [
            'name' => str_repeat('a', 256),
            'email' => 'email',
            'password' =>'123',
            'company_id' => 'a'
        ]);
        $this->assertInvalidationFields($response, ['name'], 'max.string', ['max' => 190]);
        $this->assertInvalidationFields($response, ['email'], 'email', []);
        $this->assertInvalidationFields($response, ['company_id'], 'numeric', []);
    }

    public function testStoreWithInvalidCompanyID()
    {
        $recruiter = $this->createRecruiter();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$recruiter['token']}"
        ])->postJson('/api/v1/recruiters', [
            'name' => 'Foo',
            'email' => 'foo@email.com',
            'password' => '123',
            'company_id' => 999
        ]);

        $this->assertInvalidationFields($response, ['company_id'], 'exists', ['exists' => 'companies,id']);
    }

    public function testInvalidationData()
    {
        $data = ["name" => null];
        $this->assertInvalidationInStoreAction($data, 'required');

        $data = ['name' => str_repeat('a', 256)];
        $this->assertInvalidationInStoreAction($data, 'max.string', ['max' => 190]);
    }

    protected function routeStore()
    {
        return '/api/v1/recruiters';
    }
}
