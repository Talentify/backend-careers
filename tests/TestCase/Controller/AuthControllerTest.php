<?php


namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\AuthController Test Case
 *
 * @uses \App\Controller\AuthController
 */
class AuthControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Users',
    ];

    /**
     * Test testLoginSuccess method
     *
     * @return void
     */
    public function testLoginSuccess(): void
    {

        $this->post('/auth/login.json',[
            "email" => "ps.arguelo@gmail.com",
            "password" => "123456",
        ]);

        $this->assertResponseCode(200);
    }

    /**
     * Test testInvalidLogin method
     *
     * @return void
     */
    public function testInvalidLogin(): void
    {

        $this->post('/auth/login.json',[
            "email" => "car@gmail.com",
            "password" => "4456",
        ]);

        //dd($this->_response);
        $this->assertResponseCode(400);
    }
}
