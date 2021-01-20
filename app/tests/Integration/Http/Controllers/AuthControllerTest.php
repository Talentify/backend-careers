<?php

namespace Tests\Integration\App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthControllerTest extends \TestCase
{
    use DatabaseTransactions;

    public function testIfUserCanLogIn(): void
    {
        $user = User::factory()->create(
            [
                'email'     =>  'admin@example.net',
                'password'  =>  'admin',
                'role'      =>  RolesEnum::ADMIN_ROLE,
                'status'    =>  'active'
            ]
        );

        $this->post('/api/v1/auth/login', [
            'email'     =>  'admin@example.net',
            'password'  =>  'admin',
        ])
            ->seeStatusCode(200)
            ->seeJsonStructure(
                [
                    'access_token',
                    'token_type',
                    'expires_in'
                ]
            );
    }

    public function testIfUserCanSeeInfos(): void
    {
        $user = User::factory()->create(
            [
                'email'     =>  'admin@example.net',
                'password'  =>  'admin',
                'role'      =>  RolesEnum::ADMIN_ROLE,
                'status'    =>  'active'
            ]
        );

        $this->actingAs($user)
            ->get('/api/v1/auth/me')
            ->seeJsonStructure(
                [
                    'data'  =>  [
                        'id',
                        'name',
                        'email',
                        'status',
                        'role'
                    ]
                ]
            );
    }
}
