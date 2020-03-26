<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VacanciesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Event\Event;

/**
* App\Model\Table\VacanciesTable Test Case
*/
class VacanciesTableTest extends TestCase
{
  /**
  * Test subject
  *
  * @var \App\Model\Table\VacanciesTable
  */
  public $Vacancies;

  /**
  * Fixtures
  *
  * @var array
  */
  public $fixtures = [
    'app.Vacancies',
  ];

  /**
  * setUp method
  *
  * @return void
  */
  public function setUp()
  {
    parent::setUp();
    $config = TableRegistry::getTableLocator()->exists('Vacancies') ? [] : ['className' => VacanciesTable::class];
    $this->Vacancies = TableRegistry::getTableLocator()->get('Vacancies', $config);
  }

  /**
  * tearDown method
  *
  * @return void
  */
  public function tearDown()
  {
    unset($this->Vacancies);

    parent::tearDown();
  }

  /**
  * Test validationDefault method succesfull
  *
  * @return void
  */
  public function testValidationDefault()
  {
    // Min required
    $data = [
      'title' => 'New item',
      'description' => 'Yhaaa',
      'status' => 'active'
    ];

    $entity = $this->Vacancies->newEntity($data);
    $this->assertEmpty($entity->getErrors());
  }

  /**
  * Test validationDefault method rules
  *
  * @return void
  */
  public function testValidationDefaultRules()
  {
    $data = [
      'title' => null,
      'description' => null,
      'status' => 'nactive',
      'salary' => 'aah'
    ];

    $errors = $this->Vacancies->newEntity($data)->getErrors();

    $this->assertArrayHasKey('title', $errors);
    $this->assertArrayHasKey('description', $errors);
    $this->assertArrayHasKey('status', $errors);
    $this->assertArrayHasKey('salary', $errors);
  }

  /**
  * Test findAvailable method
  *
  * @return void
  */
  public function testFindAvailable()
  {
    $this->assertEquals(9, $this->Vacancies->find('available')->count());
  }

  /**
  * Test beforeMarshal method
  *
  * @return void
  */
  public function testBeforeMarshal()
  {
    $data = new \ArrayObject([
      'salary' => '1,500.01'
    ]);

    $this->Vacancies->beforeMarshal(new Event('Model.beforeSave'), $data, new \ArrayObject());
    $this->assertTrue(is_float($data['salary']));
    $this->assertEquals(1500.01, $data['salary']);
  }
}
