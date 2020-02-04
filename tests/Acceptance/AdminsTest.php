<?php

namespace Test\Acceptance;

use Illuminate\Http\Response;
use Test\TestCase;
use Illuminate\Support\Facades\Hash;

class AdminsTest extends TestCase
{
    /**
     * Test Create Admin
     * @covers \App\Http\Controllers\AdminsController::register
     */
    public function testCreate()
    {
        $admin = factory('App\Models\Admin')->create();
        $this->be($admin, 'admin');
        $newAdmin = factory('App\Models\Admin')->make();
        
        $body = [
            'name'     => $newAdmin->name,
            'email'    => $newAdmin->email,
            'password' => $newAdmin->password,
        ];
        
        $this->json(
            'POST',
            "/v1/admins",
            $body
        )->seeStatusCode(Response::HTTP_CREATED);

        unset($body['password']);

        $this->seeInDatabase(
            'admins',
            $body
        );
    }

    /**
     * Test Update Admin
     * @covers \App\Http\Controllers\AdminsController::update
     */
    public function testUpdate()
    {
        $admin = factory('App\Models\Admin')->create();
        $newAdmin = factory('App\Models\Admin')->make();
        $this->be($admin, 'admin');
        $body = [
            'name'     => $newAdmin->name,
            'email'    => $newAdmin->email,
            'password' => $newAdmin->password,
        ];
        $this->json(
            'PATCH',
            '/v1/admins',
            $body
        )->seeStatusCode(Response::HTTP_OK);

        unset($body['password']);

        $this->seeInDatabase(
            'admins',
            $body
        );
    }

    /**
     * Test Get Admin
     * @covers \App\Http\Controllers\AdminsController::get
     */
    public function testGet()
    {
        $admin = factory('App\Models\Admin')->create();
        
        $this->be($admin, 'admin');
        
        $this->json(
            'GET',
            '/v1/admins'
        )->seeStatusCode(Response::HTTP_OK)
            ->seeJson($admin->toArray());
    }
    
    /**
     * Test Login Admin
     * @covers \App\Http\Controllers\AdminsController::login
     */
    public function testLogin()
    {
        $password = '123456';
        $admin = factory('App\Models\Admin')->create(['password' => Hash::make($password)]);
        
        
        $body = [
            'email'    => $admin->email,
            'password' => $password
        ];
        
        $this->json(
            'POST',
            '/v1/admins/login',
            $body
        )->seeStatusCode(Response::HTTP_OK);
    }
    
    /**
     * Test Login Admin
     * @covers \App\Http\Controllers\AdminsController::login
     */
    public function testInvalidLogin()
    {
        $password = '123456';
        $admin = factory('App\Models\Admin')->create(['password' => Hash::make($password)]);
        
        
        $body = [
            'email'    => $admin->email,
            'password' => '1234567'
        ];
        
        $this->json(
            'POST',
            '/v1/admins/login',
            $body
        )->seeStatusCode(Response::HTTP_UNAUTHORIZED)
        ->seeJson(
            [
                'error'   => 'Unauthorized',
                'message' => 'Invalid Credentials'
            ]
        );
        
    }
    
}
