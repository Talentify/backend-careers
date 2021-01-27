<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        $this->user = new User([
            'name' => 'Henrique Machiavelli',
            'email' => 'hsmachiavelli@gmail.com',
            'password' => password_hash('henrique', PASSWORD_DEFAULT)
        ]);
        $this->user->insert();
    }

    public function test_ShouldGetByEmail_When_ValidEmail()
    {
        $user = $this->user->getByEmail('hsmachiavelli@gmail.com');

        $this->assertIsArray($user);
        $this->assertEquals($user['email'], $this->user->getEmail());
        $this->assertEquals($user['id'], $this->user->getId());
    }

    public function tearDown(): void
    {
        $this->user->remove();
    }
}
