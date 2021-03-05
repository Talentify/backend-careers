<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Util\TestsHelper;

class RecruiterAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create a new recruiter.
     *
     * @return void
     */
    public function testCreateRecruiter()
    {
        $data = [
            'name' => 'Amadeus',
            'email' => '2amadeus.email@remail.com',
            'password' => '123456',
            'company' => "House LTDA"
        ];

        $response = $this->post('/api/recruiters', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'id' => $response->json()['data']['id']
        ]);
    }

    public function testLoginRecruiter()
    {
        $recruiter = TestsHelper::createRecruiterWithFactory();

        $response = $this->post('/api/recruiters/login', [
            'email' => $recruiter->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'token',
            ]
        ]);
    }
}
