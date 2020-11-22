<?php
namespace App\Tests\Listener;

use App\Exceptions\EmptyException;
use App\Exceptions\TooLongException;
use App\Listener\ExceptionListener;
use Doctrine\ORM\NoResultException;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
            'empty exception (404)' => [EmptyException::class, Response::HTTP_NOT_FOUND],
            'too long exception (400)' => [TooLongException::class, Response::HTTP_BAD_REQUEST],
            'no result exception (404)' => [NoResultException::class, Response::HTTP_NOT_FOUND],
            'type error (400)' => [\TypeError::class, Response::HTTP_BAD_REQUEST],
            'throwable (500)' => [\Throwable::class, Response::HTTP_INTERNAL_SERVER_ERROR],
            'http exception (400)' => [BadRequestHttpException::class, Response::HTTP_BAD_REQUEST],
            'http exception (401)' => [UnauthorizedHttpException::class, Response::HTTP_UNAUTHORIZED],
            'http exception (403)' => [AccessDeniedHttpException::class, Response::HTTP_FORBIDDEN],
            'http exception (404)' => [NotFoundHttpException::class, Response::HTTP_NOT_FOUND],
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
            $this->getExceptionMock($exception, $expected)
        );
        $this->exceptionListener->onKernelException($exceptionEvent);
        $this->assertInstanceOf(JsonResponse::class, $exceptionEvent->getResponse());
        $this->assertEquals($exceptionEvent->getResponse()->getStatusCode(), $expected);
    }

    /**
     * @param string $exceptionClass
     * @param int $statusCode
     * @return MockObject
     */
    private function getExceptionMock(string $exceptionClass, int $statusCode): MockObject
    {
        $exception = $this->createMock($exceptionClass);
        if (in_array(HttpException::class, class_parents($exceptionClass))) {
            $exception->method('getStatusCode')
                ->will($this->returnValue($statusCode));
        }
        return $exception;
    }
}