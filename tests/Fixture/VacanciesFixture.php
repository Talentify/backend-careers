<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
* VacanciesFixture
*/
class VacanciesFixture extends TestFixture
{
  /**
  * Fields
  *
  * @var array
  */
  // @codingStandardsIgnoreStart
  public $fields = [
    'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
    'title' => ['type' => 'string', 'length' => 256, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    'description' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
    'status' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    'workplace' => ['type' => 'string', 'length' => 300, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    'salary' => ['type' => 'float', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
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
        'title' => 'Lorem Ipsum',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'active',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '3200.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ],
      [
        'id' => 2,
        'title' => 'Ipsum Lorem Aciamet',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'active',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '2500.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ],
      [
        'id' => 3,
        'title' => 'Lorem Ipsum',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'active',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '3200.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ],
      [
        'id' => 4,
        'title' => 'Ipsum Lorem Aciamet',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'active',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '2500.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ],
      [
        'id' => 5,
        'title' => 'Lorem Ipsum',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'active',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '3200.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ],
      [
        'id' => 6,
        'title' => 'Ipsum Lorem Aciamet',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'active',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '2500.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ],
      [
        'id' => 7,
        'title' => 'Lorem Ipsum',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'active',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '3200.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ],
      [
        'id' => 8,
        'title' => 'Ipsum Lorem Aciamet',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'inactive',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '2500.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ],
      [
        'id' => 9,
        'title' => 'Lorem Ipsum',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'active',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '3200.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ],
      [
        'id' => 10,
        'title' => 'Ipsum Lorem Aciamet',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dictum sollicitudin nisl sed feugiat. Donec vestibulum nisi a nulla auctor, at ornare velit iaculis. Donec in felis ipsum. Phasellus vitae diam eu arcu lacinia consequat a et massa. Phasellus eget velit nunc. Praesent pretium ultrices mauris, id volutpat augue gravida non. Nulla sollicitudin magna elit, quis pharetra ex cursus in. Nunc sagittis leo quis risus tristique, sed facilisis sapien blandit. Etiam ultrices condimentum lacus imperdiet ullamcorper. Vestibulum bibendum tortor a quam sagittis luctus. Donec ac consequat leo, ut consectetur nibh.',
        'status' => 'active',
        'workplace' => 'Av Lorem, 29 - Ipsum - Aciamet',
        'salary' => '2500.00',
        'created_at' => '2020-03-25 01:00:00',
        'updated_at' => '2020-03-25 01:00:00',
      ]
    ];
    parent::init();
  }
}
