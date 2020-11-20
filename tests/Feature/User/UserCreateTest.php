<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function should_return_status_code_201_and_user_created_when_params_is_valid()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password(6, 20),
        ];

        $response = $this->post($this::BASE_URL . $this::REGISTRATIONS, $data);
        $response->assertStatus(201);
    }

    /**
     * @test
     * @dataProvider providerError
     */
    public function should_return_status_code_422($data, $inputErro)
    {
        $response = $this->post($this::BASE_URL . $this::REGISTRATIONS, $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors($inputErro);
    }

    public function providerError()
    {
        $this->refreshApplication();

        return [
            'when name is blank' => [
                'data' => [
                    'name' => '',
                    'email' => 'test@test.com',
                    'password' => '123456',
                ],
                'inputErro' => 'name'
            ],
            'when name not is string' => [
                'data' => [
                    'name' => 123,
                    'email' => 'test@test.com',
                    'password' => '123456',
                ],
                'inputErro' => 'name'
            ],
            'when the name has more than 20 characters' => [
                'data' => [
                    'name' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                    'email' => 'test@test.com',
                    'password' => '123456',
                ],
                'inputErro' => 'name'
            ],
            'when the name has less than 3 characters' => [
                'data' => [
                    'name' => 'aa',
                    'email' => 'test@test.com',
                    'password' => '123456',
                ],
                'inputErro' => 'name'
            ],
            'when the password has less than 6 characters' => [
                'data' => [
                    'name' => 'teste',
                    'email' => 'test@test.com',
                    'password' => '123',
                ],
                'inputErro' => 'password'
            ],
            'when the password has more than 20 digits' => [
                'data' => [
                    'name' => 'teste',
                    'email' => 'test@test.com',
                    'password' => '1111111111111111111111',
                ],
                'inputErro' => 'password'
            ],
            'when the password is blank' => [
                'data' => [
                    'name' => 'teste',
                    'email' => 'test@test.com',
                    'password' => '',
                ],
                'inputErro' => 'password'
            ],
            'when email is blank' => [
                'data' => [
                    'name' => 'teste',
                    'email' => '',
                    'password' => '123456',
                ],
                'inputErro' => 'email'
            ],
            'when email not is string' => [
                'data' => [
                    'name' => 'teste',
                    'email' => 31,
                    'password' => '123456',
                ],
                'inputErro' => 'email'
            ],
        ];
    }
}
