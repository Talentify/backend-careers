<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    const BASE_URL = '/api/v1';
    const REGISTRATIONS = '/registrations';
    const LOGIN = '/login';

    protected function signIn()
    {
        $user = User::factory()->make();
        $this->actingAs($user);

        return $user;
    }

    protected function withErrors()
    {
        $this->withoutExceptionHandling();
    }
}
