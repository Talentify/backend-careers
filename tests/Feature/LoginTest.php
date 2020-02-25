<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testUserCanViewLoginForm()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('login.index');
    }

    public function testSimpleUserCannotAccessAdminArea()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/admin');
        $response->assertRedirect('/');
    }

    public function testAdminUserCanAccessAdminArea()
    {
        Session::start();

        $user = factory(User::class)->create(
            [
                'uuid' => Str::uuid()->toString(),
                'password' => bcrypt($password = 'talentify'),
                'user_admin' => 1
            ]
        );

        $response = $this->post(
            '/login/login',
            [
                'email' => $user->email,
                'password' => $password,
                '_token' => Session::token(),
            ]
        );

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
        $this->actingAs($user)->get('/admin/jobs/index');
    }

    public function testUserCanNotAccessWithIncorrectPassword()
    {
        Session::start();

        $user = factory(User::class)->create(
            [
                'uuid' => Str::uuid()->toString(),
                'password' => bcrypt($password = 'talentify'),
                'user_admin' => 0
            ]
        );

        $response = $this->post(
            '/login/login',
            [
                'email' => $user->email,
                'password' => 'incorrect_password',
                '_token' => Session::token(),
            ]
        );

        $response->assertStatus(200);
        $this->assertGuest();
        $this->assertInvalidCredentials(
            [
                'email' => $user->email,
                'password' => 'incorrect_password',
            ]
        );
    }
}
