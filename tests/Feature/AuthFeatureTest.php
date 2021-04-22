<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthFeatureTest extends TestCase
{
    use RefreshDatabase;

    private $token;

    // It's executed before each test
    protected function setUp(): void
    {
        parent::setUp();

        // configure the jwt and refresh expires to only 1 minute because it's a test.
        config(['jwt.ttl' => 1, 'refresh_ttl' => 1]);

        // create a user
        $user = factory(User::class)->create();

        // generate a JWT Token from user inserted in DB and save in $token property
        $this->token = JWTAuth::fromUser($user);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_authenticate()
    {
        $this->createUser();

        $response = $this->post('/api/v1/auth/login', [
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    public function test_it_cant_authenticate_with_invalid_email_or_password()
    {
        $this->createUser();

        $response = $this->post('/api/v1/auth/login', [
            'email' => 'testando@testando.com',
            'password' => 'não_existe'
        ]);

        $response->assertStatus(401);
    }


    public function test_it_can_logout()
    {
        $response = $this->post('/api/v1/auth/logout', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'msg'
            ]);
    }

    public function test_it_cant_logout_without_authorization_bearer()
    {
        $response = $this->post('/api/v1/auth/logout');

        $response->assertStatus(401);
    }

    public function test_it_can_refresh_token()
    {
        $response = $this->post('/api/v1/auth/refresh-token', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in'
            ]);
    }


    public function test_it_cant_refresh_token_without_authorization_bearer()
    {
        $response = $this->post('/api/v1/auth/refresh-token');

        $response->assertStatus(401);
    }

    public function test_it_can_return_logged_user()
    {
        $response = $this->post('/api/v1/auth/logged-user', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'username', 'email', 'email_verified_at', 'created_at', 'updated_at'
            ]);
    }

    public function test_it_cant_return_logged_user_without_authorization_bearer()
    {
        $response = $this->post('/api/v1/auth/logged-user', [], ['Authorization' => 'Bearer ' . $this->token]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id', 'username', 'email', 'email_verified_at', 'created_at', 'updated_at'
            ]);
    }

    private function createUser() {
        // create a user
        User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);
    }
}
