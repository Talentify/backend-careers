<?php
namespace App\Tests\Service;

use App\Entity\Job;
use App\Interfaces\DoctrineEntityServiceInterface;
use App\Service\JobService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class JobServiceTest extends TestCase
{
    /**
     * @var JobService
     */
    private JobService $jobService;

    public function setUp(): void
    {
        $this->jobService = new JobService();
    }

    public function testInstanceOfDoctrineEntityServiceInterface(): void
    {
        $this->assertInstanceOf(DoctrineEntityServiceInterface::class, $this->jobService);
    }

    public function testSuccessSetEntityManager(): void
    {
        $this->assertInstanceOf(JobService::class, $this->jobService->setEntityManager($this->getMockedEntityManager()));
    }

    public function testSuccessGetEntityRepository(): void
    {
        $this->assertInstanceOf(EntityRepository::class, $this->jobService->getEntityRepository());
    }

    /**
     * @return array
     */
    public function validFindProvider(): array
    {
        return [
            'complete params' => [
                [['identifier' => 1], ['identifier' => 'ASC'], 3, 0],
                array_fill(0, 1, $this->createMock(Job::class))
            ],
            'without order by' => [
                [['identifier' => 1], null, 1, 0],
                array_fill(0, 3, $this->createMock(Job::class))
            ],
            'without limit' => [
                [['identifier' => 1], ['identifier' => 'ASC'], null, 0],
                array_fill(0, 1, $this->createMock(Job::class))
            ],
            'without offset' => [
                [['identifier' => 1], ['identifier' => 'ASC'], 3, null],
                array_fill(0, 1, $this->createMock(Job::class))
            ],
            'with empty criteria' => [
                [[], ['identifier' => 'ASC'], 3, 0],
                array_fill(0, 3, $this->createMock(Job::class))
            ]
        ];
    }

    public function invalidFindProvider(): array
    {
        return [
            'no results' => [[], NoResultException::class],
        ];
    }

    /**
     * @param array $criteria
     * @param $mockWillReturn
     *
     * @dataProvider validFindProvider
     */
    public function testSuccessFind(array $criteria, $mockWillReturn): void
    {
        $this->jobService->setEntityManager($this->getMockedEntityManager($mockWillReturn));
        $results = $this->jobService->find(...$criteria);
        $this->assertIsArray($results);
        array_walk($results, function ($result) {
            $this->assertInstanceOf(Job::class, $result);
        });
    }

    /**
     * @param $mockWillReturn
     * @param $excepted
     *
     * @dataProvider invalidFindProvider
     */
    public function testFailureFind($mockWillReturn, $excepted): void
    {
        $this->jobService->setEntityManager($this->getMockedEntityManager($mockWillReturn));
        $this->expectException($excepted);
        $this->jobService->find([], null, null, null);
    }

    public function testSuccessPersist(): void
    {
        $this->assertInstanceOf(JobService::class, $this->jobService->persist($this->createMock(Job::class)));
    }

    public function testSuccessGetEntityClass(): void
    {
        $entityClass = $this->jobService->getEntityClass();
        $this->assertIsString($entityClass);
        $this->assertTrue(class_exists($entityClass));
    }

    /**
     * @param array|null $repositoryFindReturn
     * @return EntityManagerInterface|Stub
     */
    private function getMockedEntityManager(?array $repositoryFindReturn)
    {
        $entityManager = $this->createStub(EntityManagerInterface::class);
        $entityManager->method('getRepository')
            ->will($this->returnValue($this->getMockedEntityRepository($repositoryFindReturn ?? [])));
        return $entityManager;
    }

    /**
     * @param array $returnValue
     * @return EntityRepository|Stub
     */
    private function getMockedEntityRepository(array $returnValue)
    {
        $entityRepository = $this->createStub(EntityRepository::class);
        $entityRepository->method('findBy')
            ->will($this->returnValue($returnValue));
        return $entityRepository;
    }
}