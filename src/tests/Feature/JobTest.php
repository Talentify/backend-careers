<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Job;

class JobTest extends TestCase
{

    public function testCreateJobWithoutToken()
    {
        $job = Job::factory()->make()->toArray();
        $response = $this->postJson('/api/jobs', $job);

        $response->assertStatus(401);
    }

    public function testCreateJob()
    {

        $job = Job::factory()->make()->toArray();
        $response = $this->postJson(
                '/api/jobs',
                $job,
                [
                    'Authorization: Bearer ' . $this->getToken()
                ]
        );

        $response->assertStatus(201);
        $response->assertJson(
                [
                    'success' => true
                ]
        );
    }

    public function testCreateJobWithoutTitle()
    {
        $job = Job::factory()->make()->toArray();
        unset($job['title']);
        $response = $this->postJson('/api/jobs', $job, [
            'Authorization: Bearer ' . $this->getToken()
        ]);

        $response->assertStatus(422);
        $response->assertJson(
                [
                    'success' => false,
                    'code' => 422
                ]
        );
    }

    public function testCreateJobWithoutDescription()
    {
        $job = Job::factory()->make()->toArray();
        unset($job['description']);
        $response = $this->postJson('/api/jobs', $job, [
            'Authorization: Bearer ' . $this->getToken()
        ]);

        $response->assertStatus(422);
        $response->assertJson(
                [
                    'success' => false,
                    'code' => 422
                ]
        );
    }

    public function testCreateJobWithoutStatus()
    {
        $job = Job::factory()->make()->toArray();
        unset($job['status']);
        $response = $this->postJson('/api/jobs', $job, [
            'Authorization: Bearer ' . $this->getToken()
        ]);

        $response->assertStatus(422);
        $response->assertJson(
                [
                    'success' => false,
                    'code' => 422
                ]
        );
    }

    public function testCreateJobWithWrongSalary()
    {
        $job = Job::factory()->make()->toArray();
        $job['salary'] = '9,5';
        $response = $this->postJson('/api/jobs', $job, [
            'Authorization: Bearer ' . $this->getToken()
        ]);

        $response->assertStatus(422);
        $response->assertJson(
                [
                    'success' => false,
                    'code' => 422
                ]
        );
    }

    public function testCreateJobWithWrongStatus()
    {
        $job = Job::factory()->make()->toArray();
        $job['status'] = 'Inactive';
        $response = $this->postJson('/api/jobs', $job, [
            'Authorization: Bearer ' . $this->getToken()
        ]);

        $response->assertStatus(422);
        $response->assertJson(
                [
                    'success' => false,
                    'code' => 422
                ]
        );
    }

    private function getToken(): string
    {
        $tokenRequest = $this->postJson('/api/auth/login', [
            'username' => 'talentify',
            'password' => 'talentify'
        ]);

        return (
                $tokenRequest->decodeResponseJson()
                )['data']['access_token'];
    }

}
