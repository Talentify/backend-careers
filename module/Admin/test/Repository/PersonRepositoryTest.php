<?php

namespace AdminTest\Repository;

use Admin\Entity\Person;
use AdminTest\TestCase;
use Carbon\Carbon;

class PersonRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 22:00:00'));

        $this->defaultDataset();
    }

    /**
     * @param array $data
     * @param Person $expected
     * @param int|null $personId
     *
     * @dataProvider dataProviderSave
     */
    public function testSave(
        array $data,
        Person $expected,
        int $personId = null
    )
    {
        $repository = $this->em->getRepository(Person::class);
        $person = $repository->save($data, $personId);

        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals($expected, $person);
    }

    public function testInsertDuplicateEmail()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Já existe um cadastro com esse e-mail');

        $repository = $this->em->getRepository(Person::class);
        $repository->save(
            [
                'name' => 'Paulo Teste',
                'email' => 'paulolavoratti@hotmail.com',
                'password' => 'teste'
            ],
            null
        );
    }

    public function testFindLogin()
    {
        $expected = new Person(
            [
                'id' => 1,
                'name' => 'Paulo Lavoratti',
                'email' => 'paulolavoratti@hotmail.com',
                'password' => md5('teste'),
                'createdAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 23:52:52'),
                'updatedAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 23:52:52'),
            ]
        );

        $reposiroty = $this->em->getRepository(Person::class);

        $person = $reposiroty->findLogin('paulolavoratti@hotmail.com', 'teste');

        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals($expected, $person);
    }

    public function dataProviderSave()
    {
        return [
            'insert-person' => [
                [
                    'name' => 'Paulo Teste',
                    'email' => 'paulolavoratti@gmail.com',
                    'password' => 'teste'
                ],
                new Person(
                    [
                        'id' => 3,
                        'name' => 'Paulo Teste',
                        'email' => 'paulolavoratti@gmail.com',
                        'password' => md5('teste'),
                        'createdAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 22:00:00'),
                        'updatedAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 22:00:00'),
                    ]
                ),
                null
            ],
            'updated-pessoa' => [
                [
                    'name' => 'Paulo Vinicius Lavoratti',
                    'email' => 'paulolavoratti@hotmail.com',
                ],
                new Person(
                    [
                        'id' => 1,
                        'name' => 'Paulo Vinicius Lavoratti',
                        'email' => 'paulolavoratti@hotmail.com',
                        'password' => md5('teste'),
                        'createdAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 23:52:52'),
                        'updatedAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 22:00:00'),
                    ]
                ),
                1
            ]
        ];
    }
}