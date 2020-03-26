<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Bootstrap extends AbstractMigration
{
  /**
  * Change Method.
  *
  * More information on this method is available here:
  * http://docs.phinx.org/en/latest/migrations.html#the-change-method
  * @return void
  */
  public function change()
  {
    $this->table('users')
      ->addColumn('name', 'string', ['limit' => 80])
      ->addColumn('email', 'string', ['limit' => 120])
      ->addColumn('password', 'string', ['limit' => 255])
      ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->create();

    $this->table('vacancies')
      ->addColumn('title', 'string', ['limit' => 256])
      ->addColumn('description', 'text')
      ->addColumn('status', 'enum', ['values' => ['active', 'inactive']]) // I just don't like enum, though here it is
      ->addColumn('workplace', 'string', ['limit' => 300, 'null' => true])
      ->addColumn('salary', 'double', ['precision' => 10, 'scale' => 2, 'null' => true])
      ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->create();
  }
}
