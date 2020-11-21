<?php
namespace App\Tests\Service;

use App\Entity\User;
use App\Interfaces\DoctrineEntityServiceInterface;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * @var UserService
     */
    private UserService $userService;

    public function setUp(): void
    {
        $this->userService = new UserService();
        $this->userService->setEntityManager($this->getMockedEntityManager(null));
    }

    public function testInstanceOfDoctrineEntityServiceInterface(): void
    {
        $this->assertInstanceOf(DoctrineEntityServiceInterface::class, $this->userService);
    }

    public function testSuccessSetEntityManager(): void
    {
        $this->assertInstanceOf(UserService::class, $this->userService->setEntityManager($this->getMockedEntityManager(null)));
    }

    public function testSuccessGetEntityRepository(): void
    {
        $this->assertInstanceOf(EntityRepository::class, $this->userService->getEntityRepository(''));
    }

    /**
     * @return array
     */
    public function validFindProvider(): array
    {
        $userMock = $this->createMock(User::class);
        return [
            'complete params' => [
                [['username' => 'a'], ['username' => 'ASC'], 3, 0],
                array_fill(0, 1, $userMock)
            ],
            'without order by' => [
                [['username' => 'a'], null, 1, 0],
                array_fill(0, 3, $userMock)
            ],
            'without limit' => [
                [['username' => 'a'], ['username' => 'ASC'], null, 0],
                array_fill(0, 1, $userMock)
            ],
            'without offset' => [
                [['identifier' => 'a'], ['username' => 'ASC'], 3, null],
                array_fill(0, 1, $userMock)
            ],
            'with empty criteria' => [
                [[], ['username' => 'ASC'], 3, 0],
                array_fill(0, 3, $userMock)
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
        $this->userService->setEntityManager($this->getMockedEntityManager($mockWillReturn));
        $results = $this->userService->find(...$criteria);
        $this->assertIsArray($results);
        array_walk($results, function ($result) {
            $this->assertInstanceOf(User::class, $result);
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
        $this->userService->setEntityManager($this->getMockedEntityManager($mockWillReturn));
        $this->expectException($excepted);
        $this->userService->find([], null, null, null);
    }

    public function testSuccessPersist(): void
    {
        $this->assertInstanceOf(User::class, $this->userService->persist($this->createMock(User::class)));
    }

    public function testSuccessGetEntityClass(): void
    {
        $entityClass = $this->userService->getEntityClass();
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