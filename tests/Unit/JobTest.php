<?php

namespace Tests\Unit;

use Tests\TestCase;

class JobTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    protected $job = [
        'title' => 'Engenheiro Software',
        "description" => "Engenheiro Software Senior",
        'status' => 'active',
        'workplace' => [
            'state' => 'MG',
            'city' => 'BH',
            'district' => 'Cândido de Souza',
            'number' => 994
        ],
        'salary' => 99.99
    ];

    public function testAuthenticateUser()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'email' => 'user@user.com',
                "password" => "123456"
            ]
        );
        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function testAuthenticateAdmin()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'email' => 'admin@admin.com',
                "password" => "123456"
            ]
        );
        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function testCreateJob()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'email' => 'admin@admin.com',
                "password" => "123456"
            ]
        );
        $token = json_decode($response->getContent())->token;

        $response = $this->postJson(
            '/api/jobs',
            $this->job,
            ['Authorization' => "Bearer $token"]
        );
        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['title']]);
    }

    public function testListAllJobs()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'email' => 'user@user.com',
                "password" => "123456"
            ]
        );
        $token = json_decode($response->getContent())->token;

        $response = $this->getJson('/api/jobs', ['Authorization' => "Bearer $token"]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    public function testeUnauthorizedUserCreatingJobs()
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'email' => 'user@user.com',
                "password" => "123456"
            ]
        );
        $token = json_decode($response->getContent())->token;

        $response = $this->postJson(
            '/api/jobs',
            $this->job,
            ['Authorization' => "Bearer $token"]
        );
        $response->assertStatus(422);
        $response->assertJsonStructure(['error']);
    }
}
