<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker;

    public function testUserCanAuthenticateWithValidCredentials()
    {
        $password = $this->faker->password;

        $user = User::factory(['password' => bcrypt($password)])->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);

        $this->assertNotEmpty($response->json('token'));
    }

    public function testUserCanNotAuthenticateWithIncorrectCredentials()
    {
        $password = $this->faker->password;

        $user = User::factory(['password' => bcrypt($password)])->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'invalid password',
        ]);
        $response->assertStatus(400);

        $this->assertEmpty($response->json('token'));
    }
}
