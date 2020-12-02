<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UsersTest extends TestCase
{
    public function testLoginShouldReturnNullWhenIncorrectCredentials()
    {
        $user = User::factory()->create();

        $response = $this->postJson('login', [
            'email'    => $user->email,
            'password' => 'wrongPassword'
        ]);

        $response->assertStatus(401);
    }

    public function testLoginShouldReturnUsersApiToken()
    {
        $user = User::factory()->create();

        $response = $this->postJson('login', [
            'email'    => $user->email,
            'password' => 'password'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'api_token' => $user->api_token
            ]);
    }

    public function testCreateAnUserShouldFailWhenAlreadyExistsUserWithSameEmail()
    {
        $user = User::factory()->create();

        $response = $this->postJson('users', [
            'name' => $this->faker->name,
            'email' => $user->email,
            'password' => 'password123'
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors('email');
    }

    public function testCreateAnUserShouldSuccess()
    {
        $data = User::factory()->raw();

        $response = $this->postJson('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => 'password'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'email' => $data['email']
            ]);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }
}
