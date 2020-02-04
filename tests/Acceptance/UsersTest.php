<?php

namespace Test\Acceptance;

use Illuminate\Http\Response;
use Test\TestCase;
use Illuminate\Support\Facades\Hash;

class UsersTest extends TestCase
{
    /**
     * Test Create User
     * @covers \App\Http\Controllers\UsersController::register
     */
    public function testCreate()
    {
        
        $user = factory('App\Models\User')->make();
        
        $body = [
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => $user->password,
        ];
        
        $this->json(
            'POST',
            "/v1/users",
            $body
        )->seeStatusCode(Response::HTTP_CREATED);

        unset($body['password']);

        $this->seeInDatabase(
            'users',
            $body
        );
    }

    /**
     * Test Update User
     * @covers \App\Http\Controllers\UsersController::update
     */
    public function testUpdate()
    {
        $user = factory('App\Models\User')->create();
        $newUser = factory('App\Models\User')->make();
        $this->be($user, 'user');
        $body = [
            'name'     => $newUser->name,
            'email'    => $newUser->email,
            'password' => $newUser->password,
        ];
        $this->json(
            'PATCH',
            '/v1/users',
            $body
        )->seeStatusCode(Response::HTTP_OK);

        unset($body['password']);

        $this->seeInDatabase(
            'users',
            $body
        );
    }

    /**
     * Test Get User
     * @covers \App\Http\Controllers\UsersController::get
     */
    public function testGet()
    {
        $user = factory('App\Models\User')->create();
        
        $this->be($user, 'user');
        
        $this->json(
            'GET',
            '/v1/users'
        )->seeStatusCode(Response::HTTP_OK)
            ->seeJson($user->toArray());
    }
    
    /**
     * Test Login User
     * @covers \App\Http\Controllers\UsersController::login
     */
    public function testLogin()
    {
        $password = '123456';
        $user = factory('App\Models\User')->create(['password' => Hash::make($password)]);
        
        
        $body = [
            'email'    => $user->email,
            'password' => $password
        ];
        
        $this->json(
            'POST',
            '/v1/users/login',
            $body
        )->seeStatusCode(Response::HTTP_OK);
    }
    
    /**
     * Test Login User
     * @covers \App\Http\Controllers\UsersController::login
     */
    public function testInvalidLogin()
    {
        $password = '123456';
        $user = factory('App\Models\User')->create(['password' => Hash::make($password)]);
        
        
        $body = [
            'email'    => $user->email,
            'password' => '1234567'
        ];
        
        $this->json(
            'POST',
            '/v1/users/login',
            $body
        )->seeStatusCode(Response::HTTP_UNAUTHORIZED)
        ->seeJson(
            [
                'error'   => 'Unauthorized',
                'message' => 'Invalid Credentials'
            ]
        );
        
    }
    
    /**
     * Test Delete User
     * @covers \App\Http\Controllers\UsersController::delete
     */
    public function testDeleteUser()
    {
        $admin = factory('App\Models\Admin')->create();
        $this->be($admin, 'admin');
        $user = factory('App\Models\User')->create();

        
        $this->json(
            'DELETE',
            '/v1/users/'.$user->id
        )->seeStatusCode(Response::HTTP_NO_CONTENT)
        ->notSeeInDatabase(
            'users',
            [
                'id' => $user->id,
                'deleted_at' => null
            ]
        );
        
    }
   
}
