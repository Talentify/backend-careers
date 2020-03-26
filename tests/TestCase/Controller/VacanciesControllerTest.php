<?php
namespace App\Test\TestCase\Controller;

use App\Controller\Admin\VacanciesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
* App\Controller\VacanciesController Test Case
*
* @uses \App\Controller\VacanciesController
*/
class VacanciesControllerTest extends TestCase
{
  use IntegrationTestTrait;

  /**
  * Fixtures
  *
  * @var array
  */
  public $fixtures = [
    'app.Vacancies'
  ];

  /**
   * Test index method
   * @return void
   */
  public function testIndex()
  {
    // Setup session
    $this->session([
      'Auth' => [
        'User' => [
          'id' => 1,
          'name' => 'Tester',
          'email' => 'tester@testing.local',
        ]
      ]
    ]);
    $this->get('/');
    $this->assertResponseOk();
  }
}
