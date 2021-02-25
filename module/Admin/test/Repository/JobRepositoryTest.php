<?php

namespace AdminTest\Repository;

use Admin\Entity\Job;
use AdminTest\TestCase;
use Carbon\Carbon;

class JobRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 22:00:00'));

        $this->defaultDataset(
            [
                'jobs' => [
                    ['id', 'person_id', 'title', 'description', 'status', 'workplace', 'salary', 'created_at', 'updated_at'],
                    [1, 1, 'Teste Vaga', 'Vaga teste', 1, 'Rua Saldanha Marinho, 1453', 8000.00, '2021-02-23 23:52:52', '2021-02-23 23:52:52'],
                    [2, 1, 'Teste Vaga', 'Vaga teste', 0, 'Rua Saldanha Marinho, 1453', 8000.00, '2021-02-23 23:52:52', '2021-02-23 23:52:52'],
                ]
            ],
        );
    }

    /**
     * @param array $data
     * @param Job $expected
     * @param int|null $jobId
     * @dataProvider dataProviderSave
     */
    public function testSave(
        array $data,
        Job $expected,
        int $jobId = null
    )
    {
        $repository = $this->em->getRepository(Job::class);
        $job = $repository->save($data, $jobId);

        $this->assertInstanceOf(Job::class, $job);
        $this->assertEquals(
            $expected->toArray(),
            $job->toArray()
        );
    }

    public function testSaveJobDoesNotBelongToYou()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Essa vaga não pertence a você!');

        $repository = $this->em->getRepository(Job::class);
        $repository->save(
            [
                'personId' => 2,
                'title' => 'Teste Vaga',
                'description' => 'Quero entrar na talentify',
                'status' => 1,
                'workplace' => 'Rua Amazonas, 589',
                'salary' => 9000.0
            ],
            1
        );
    }

    public function testFetch()
    {
        $repository = $this->em->getRepository(Job::class);

        $results = $repository->fetch();

        $this->assertIsArray($results);
        $this->assertEquals(
            [
                [
                    'id' => 1,
                    'title' => 'Teste Vaga',
                    'description' => 'Vaga teste',
                    'status' => true,
                    'workplace' => 'Rua Saldanha Marinho, 1453',
                    'salary' => 8000.0
                ]
            ],
            $results
        );
    }

    public function dataProviderSave()
    {
        return [
            'insert-job' => [
                [
                    'personId' => 1,
                    'title' => 'Teste Vaga',
                    'description' => 'Quero entrar na talentify',
                    'status' => 1,
                    'workplace' => 'Rua Amazonas, 589',
                    'salary' => 9000.0
                ],
                new Job(
                    [
                        'id' => 3,
                        'title' => 'Teste Vaga',
                        'description' => 'Quero entrar na talentify',
                        'status' => 1,
                        'workplace' => 'Rua Amazonas, 589',
                        'salary' => 9000.0,
                        'createdAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 22:00:00'),
                        'updatedAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 22:00:00'),
                    ]
                ),
                null
            ],
            'updated-job' => [
                [
                    'personId' => 1,
                    'title' => 'Teste Vaga',
                    'description' => 'Quero entrar na talentify',
                    'status' => 1,
                    'workplace' => 'Rua Amazonas, 589',
                    'salary' => 9000.0
                ],
                new Job(
                    [
                        'id' => 1,
                        'title' => 'Teste Vaga',
                        'description' => 'Quero entrar na talentify',
                        'status' => 1,
                        'workplace' => 'Rua Amazonas, 589',
                        'salary' => 9000.0,
                        'createdAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 23:52:52'),
                        'updatedAt' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-02-23 22:00:00'),
                    ]
                ),
                1
            ]
        ];
    }
}