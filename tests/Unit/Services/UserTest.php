<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\User;
use App\Services\UserService;

class UserTest extends TestCase
{
    public function testFindUserByCredentialShouldReturnUserWhenCorrectCredentialsPassed()
    {
        $password = '123456';
        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);

        $findUser = app(UserService::class)->findByCredentials(
            $user->email,
            $password
        );

        $this->assertNotNull($findUser);
        $this->assertEquals($findUser->id, $user->id);
    }

    public function testFindUserByCredentialShouldReturnNullWhenIncorrectCredentialsPassed()
    {
        $user = User::factory()->create([
            'password' => bcrypt('123456')
        ]);

        $findUser = app(UserService::class)->findByCredentials(
            $user->email,
            '654321'
        );

        $this->assertNull($findUser);
    }

    public function testCreateShouldSuccessfullyReturnANewUser()
    {
        $data = User::factory()->raw();

        $createUser = app(UserService::class)->create($data);

        $this->assertNotNull($createUser);
        $this->assertEquals($data['email'], $createUser->email);
    }
}
