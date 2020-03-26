<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\UsersController;
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
  public $fixtures = [
    'app.Users',
  ];

  /**
  * Test login method
  *
  * @return void
  */
  public function testLogin()
  {
    $data = [
      'email' => 'tester@testing.local',
      'password' => '123456'
    ];

    $this->enableCsrfToken();
    $this->enableSecurityToken();

    $this->post('/admin/users/login', $data);

    $this->assertRedirect('/admin');
  }

  /**
  * Test logout method
  *
  * @return void
  */
  public function testLogout()
  {
    $this->get('/admin/users/logout');
    $this->assertRedirect('/admin/users/login');
  }
}
