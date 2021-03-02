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
     * Test testAddUser method
     *
     * @return void
     */
    public function testAddUser(): void
    {
        $this->post('/users/add.json', [
            "name" => "Jon",
            "email" => "jon@gmail.com",
            "company" => "Facebook",
            "password" => "123456"
        ]);

        $this->assertResponseCode(200);

    }

    /**
     * Test testAddUserWithUsedEmail method
     *
     * @return void
     */
    public function testAddUserWithUsedEmail(): void
    {
        $this->post('/users/add.json',[
            "name" => "Paul",
            "email" => "ps.arguelo@gmail.com",
            "password" => "123456",
        ]);
        $this->assertResponseCode(400);
    }




    public function testList() : void
    {
        $this->get('/users/list.json');
        $this->assertResponseCode(401);
    }


}
