<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\VacanciesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

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
    'app.Vacancies',
    'app.Users',
  ];

  /**
   * Not Logged index
   * @return void
   */
  public function testIndex()
  {
    $this->get('/admin/');
    $this->assertRedirect('/admin/users/login?redirect=%2Fadmin%2F');
  }

  /**
   * Logged index
   * @return void
   */
  public function testIndexLogged()
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
    $this->get('/admin/');
    $this->assertResponseOk();
  }

  /**
  * Test add method (successfull call)
  *
  * @return void
  */
  public function testAdd()
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

    $data = [
      'title' => 'Another Vacancy',
      'description' => 'Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nu. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nu.',
      'workplace' => 'Convallis morbi fringilla gravida, phasellus',
      'salary' => '1,500.09',
      'status' => 'active',
    ];

    // Perform a safe request
    $this->enableCsrfToken();
    $this->enableSecurityToken();
    $this->post('/admin/vacancies/add', $data);

    $this->assertRedirect('/admin');
    $this->assertFlashMessage('Vaga publicada com sucesso');

    $config = TableRegistry::getTableLocator()->exists('Vacancies') ? [] : ['className' => VacanciesTable::class];
    $this->Vacancies = TableRegistry::getTableLocator()->get('Vacancies', $config);

    // Check wheter vacancy has been save
    $this->assertEquals(11, $this->Vacancies->find()->count());
    $vacancy = $this->Vacancies->find()->last();

    // Checl wheter all passed fields have been updated
    $this->assertEquals($data['title'], $vacancy->title);
    $this->assertEquals($data['description'], $vacancy->description);
    $this->assertEquals($data['workplace'], $vacancy->workplace);
    $this->assertEquals(1500.09, $vacancy->salary);
    $this->assertEquals($data['status'], $vacancy->status);
  }

  /**
  * Test deleteComment method
  *
  * @return void
  */
  public function testEdit()
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

    $data = [
      'title' => 'Another Vacancyy',
      'description' => 'Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nu. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nu.',
      'workplace' => 'Convallis morbi fringilla gravida, phasellus',
      'salary' => '1,501.01',
      'status' => 'active',
    ];

    // Perform a safe request
    $this->enableCsrfToken();
    $this->enableSecurityToken();
    $this->put('/admin/vacancies/edit/1', $data);

    $this->assertRedirect('/admin');
    $this->assertFlashMessage('Vaga atualizada com sucesso');

    $config = TableRegistry::getTableLocator()->exists('Vacancies') ? [] : ['className' => VacanciesTable::class];
    $this->Vacancies = TableRegistry::getTableLocator()->get('Vacancies', $config);

    $vacancy = $this->Vacancies->get(1);

    // Checl wheter all passed fields have been updated
    $this->assertEquals($data['title'], $vacancy->title);
    $this->assertEquals($data['description'], $vacancy->description);
    $this->assertEquals($data['workplace'], $vacancy->workplace);
    $this->assertEquals(1500.01, $vacancy->salary);
    $this->assertEquals($data['status'], $vacancy->status);
  }
}
