<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;
use Cake\Auth\DefaultPasswordHasher;

/**
* UsersFixture
*/
class UsersFixture extends TestFixture
{
  /**
  * Fields
  *
  * @var array
  */
  // @codingStandardsIgnoreStart
  public $fields = [
    'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
    'name' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    'email' => ['type' => 'string', 'length' => 120, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    'created_at' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
    'updated_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
    '_constraints' => [
      'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
    ],
    '_options' => [
      'engine' => 'InnoDB',
      'collation' => 'utf8_general_ci'
    ],
  ];
  // @codingStandardsIgnoreEnd
  /**
  * Init method
  *
  * @return void
  */
  public function init()
  {
    $this->records = [
      [
        'id' => 1,
        'name' => 'Tester',
        'email' => 'tester@testing.local',
        'password' => (new DefaultPasswordHasher)->hash('123456'),
        'created_at' => '2020-03-02 11:09:11',
        'updated_at' => '2020-03-02 11:09:11',
      ],
    ];
    parent::init();
  }
}
