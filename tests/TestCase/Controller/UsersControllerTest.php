<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
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
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->get('/users/index.json');
        $this->assertResponseCode(200);
    }


    /**
     * Test index method
     *
     * @return void
     */
    public function testAdd(): void
    {
        $this->post('/users/add.json', [
            "name" => "Paulo",
            "email" => "ps.arguelo@gmail.com",
            "password" => "123456",
        ]);


        $this->assertResponseCode(200);

    }

    /**
     * Test testAddInvalidEmail method
     *
     * @return void
     */
    public function testAddUserWithUsedEmail(): void
    {
        $this->post('/users/add.json',[
            "name" => "Paulo",
            "email" => "ps.arguelo@gmail.com",
            "password" => "123456",
        ]);
        $this->assertResponseCode(200);
    }


    /**
     * Test testAddInvalidEmail method
     *
     * @return void
     */
    public function testLogin(): void
    {

        $this->post('/users/login.json',[
            "email" => "ps.arguelo@gmail.com",
            "password" => "123456",
        ]);

        //dd($this->_response);
        $this->assertResponseCode(400);
    }

    public function testList() : void
    {
        $this->get('/users/list.json');
        $this->assertResponseCode(200);
    }


}
