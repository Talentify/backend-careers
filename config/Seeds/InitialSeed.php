<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
* Initial seed.
*/
class InitialSeed extends AbstractSeed
{
  public function run()
  {
    $users = [
      [
        'id' => 1,
        'name' => 'Tester',
        'email' => 'tester@testing.local',
        'password' => (new DefaultPasswordHasher)->hash('123456')
      ],
      [
        'id' => 2,
        'name' => 'Mr Fandangus',
        'email' => 'mr.fandangos@testing.local',
        'password' => (new DefaultPasswordHasher)->hash('123456')
      ]
    ];

    $table = $this->table('users');
    $table->insert($users)->save();

    $vacancies = [
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
        'status' => 'active',
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

    $table = $this->table('vacancies');
    $table->insert($vacancies)->save();

  }
}
