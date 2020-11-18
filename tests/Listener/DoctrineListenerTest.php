<?php
namespace App\Tests\Listener;

use App\Listener\DoctrineListener;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class DoctrineListenerTest extends WebTestCase
{
    /**
     * @var DoctrineListener
     */
    private DoctrineListener $doctrineListener;

    public function testOnKernelException(): void
    {
        $exceptionEvent = new ExceptionEvent(
            $this->createKernel(),
            Request::createFromGlobals(),
            0,
            new \Exception()
        );
        $entityManager = $this->getEntityManagerMock();
        $entityManager->expects($this->once())
            ->method('rollback');
        $this->doctrineListener = new DoctrineListener($entityManager);
        $this->doctrineListener->onKernelException($exceptionEvent);
        $this->doctrineListener->onKernelException($exceptionEvent);
    }

    public function testOnKernelResponse(): void
    {
        $entityManager = $this->getEntityManagerMock();
        $entityManager->expects($this->once())
            ->method('flush');
        $this->doctrineListener = new DoctrineListener($entityManager);
        $this->doctrineListener->onKernelResponse(new ResponseEvent(
            $this->createKernel(),
            Request::createFromGlobals(),
            0,
            $this->createMock(Response::class)
        ));
    }

    /**
     * @return EntityManagerInterface|MockObject
     */
    private function getEntityManagerMock()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->method('getConnection')
            ->will($this->returnValue($this->getConnectionStub()));
        return $entityManager;
    }

    /**
     * @return Connection|Stub
     */
    private function getConnectionStub()
    {
        $connection = $this->createStub(Connection::class);
        $connection->method('isTransactionActive')->will($this->onConsecutiveCalls(true, false));
        return $connection;
    }
}