<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use UsersTableSeeder;
use Tests\TestCase;
use Tests\Unit\UserTest;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Returns true for isAdmin.
     *
     * @return void
     */
    public function testIsUserAdmin()
    {
        $this->seed(UsersTableSeeder::class);

        $users = new UserTest();

        $user = factory(User::class)->state('admin')->make();

        $this->assertEquals($user->email, $users->testIsAdmin('admin-test@talentify.com'));
    }

    /**
     * Returns false for isAdmin.
     *
     * @return void
     */
    public function testIsNotUserAdmin()
    {
        $this->seed(UsersTableSeeder::class);

        $users = new UserTest();

        $user = factory(User::class)->state('client')->make();

        $this->assertNotEquals($user, $users->testIsAdmin('client-test@talentify.com'));
    }

    /**
     * Return true for isClient.
     *
     * @return void
     */
    public function testIsUserClient()
    {
        $this->seed(UsersTableSeeder::class);

        $users = new UserTest();

        $user = factory(User::class)->state('client')->make();

        $this->assertEquals($user->email, $users->testIsClient('client-test@talentify.com'));
    }

    /**
     * Return false for isClient.
     *
     * @return void
     */
    public function testIsNotUserClient()
    {
        $this->seed(UsersTableSeeder::class);

        $users = new UserTest();

        $user = factory(User::class)->state('admin')->make();

        $this->assertNotEquals($user, $users->testIsClient('admin-test@talentify.com'));
    }

    /**
     * Returns true for haveAuth.
     *
     * @return void
     */
    public function testHaveUserAuth()
    {
        $this->seed(UsersTableSeeder::class);

        $users = new UserTest();

        $user = factory(User::class)->state('client')->make();

        $this->assertEquals($user->email, $users->testHaveAuth('client-test@talentify.com', '$2y$10$j702KbD5lVHNOmxsEflohej9j8VsHCW01g53BRYKycsGrkgz0xknO'));
    }

    /**
     * Returns false for haveAuth.
     *
     * @return void
     */
    public function testHaventUserAuth()
    {
        $this->seed(UsersTableSeeder::class);

        $users = new UserTest();

        $user = factory(User::class)->state('client')->make();

        $this->assertNotEquals($user, $users->testHaveAuth('client-test@talentify.com', '123'));
    }
}
