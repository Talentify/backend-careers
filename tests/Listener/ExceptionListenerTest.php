<?php
namespace App\Tests\Listener;

use App\Exceptions\EmptyException;
use App\Exceptions\TooLongException;
use App\Listener\ExceptionListener;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListenerTest extends WebTestCase
{
    /**
     * @var ExceptionListener
     */
    private ExceptionListener $exceptionListener;

    public function setUp(): void
    {
        $this->exceptionListener = new ExceptionListener();
    }

    /**
     * @return array
     */
    public function exceptionsProvider(): array
    {
        return [
            'empty exception' => [EmptyException::class, Response::HTTP_NOT_FOUND],
            'too long exception' => [TooLongException::class, Response::HTTP_BAD_REQUEST],
            'no result exception' => [NoResultException::class, Response::HTTP_NOT_FOUND],
            'type error' => [\TypeError::class, Response::HTTP_BAD_REQUEST],
            'throwable' => [\Throwable::class, Response::HTTP_INTERNAL_SERVER_ERROR]
        ];
    }

    /**
     * @param string $exception
     * @param int $expected
     *
     * @dataProvider exceptionsProvider
     */
    public function testOnKernelException(string $exception, int $expected)
    {
        $exceptionEvent = new ExceptionEvent(
            $this->createKernel(),
            Request::createFromGlobals(),
            0,
            $this->createMock($exception)
        );
        $this->exceptionListener->onKernelException($exceptionEvent);
        $this->assertInstanceOf(JsonResponse::class, $exceptionEvent->getResponse());
        $this->assertEquals($exceptionEvent->getResponse()->getStatusCode(), $expected);
    }
}