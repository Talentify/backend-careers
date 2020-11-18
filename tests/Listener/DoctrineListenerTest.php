<?php
namespace App\Tests\Listener;

use App\Listener\DoctrineListener;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class DoctrineListenerTest extends TestCase
{
    /**
     * @var DoctrineListener
     */
    private DoctrineListener $doctrineListener;

    public function setUp(): void
    {
        $this->doctrineListener = new DoctrineListener($this->getEntityManagerStub());
    }

    public function testOnKernelException(): void
    {
        $this->assertNull($this->doctrineListener->onKernelException($this->createMock(ExceptionEvent::class)));
    }

    public function testOnKernelResponse(): void
    {
        $this->assertNull($this->doctrineListener->onKernelResponse($this->createMock(ResponseEvent::class)));
    }

    /**
     * @return EntityManagerInterface|Stub
     */
    private function getEntityManagerStub()
    {
        $entityManager = $this->createStub(EntityManagerInterface::class);
        $entityManager->method('getConnection')->willReturn($this->getConnectionStub());
        return $entityManager;
    }

    /**
     * @return Connection|Stub
     */
    private function getConnectionStub()
    {
        $connection = $this->createStub(Connection::class);
        $connection->method('isTransactionActive')->willReturn(true);
        return $connection;
    }
}