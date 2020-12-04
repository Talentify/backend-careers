<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginScreen()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * A post login.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get('/dashboard')
            ->assertStatus(200);
    }

    /**
     * A post login.
     *
     * @return void
     */
    public function testInvalidLogin()
    {
        $response = $this->post('/login', ['email' => '', 'password' => 'anypassword']);
        $response->assertRedirect('/');
    }
}
