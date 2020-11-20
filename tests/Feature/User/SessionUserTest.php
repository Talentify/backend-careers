<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionUserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $credentials;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->credentials = ['email' => 'joaopaulo@email.com', 'password' => 'secret'];
    }

    /**
     * @test
     */
    public function should_authenticate_the_user_and_return_token_when_credentials_is_valid()
    {
        User::factory()->create(['name' => 'joaopaulo', 'email' => 'joaopaulo@email.com', 'password' => 'secret']);

        $response = $this->post($this::BASE_URL . $this::LOGIN, $this->credentials);

        $response->assertStatus(200);
        $this->assertArrayHasKey('access_token', $response->json());
    }

    public function test_should_return_error_unauthorized_and_status_code_401_when_credentials_is_not_valid()
    {
        User::factory()->create();

        $response = $this->post('/api/v1/login', $this->credentials);

        $response->assertStatus(401);

        $this->assertEquals(['error' => 'Unauthorized'], $response->json());
    }
}
