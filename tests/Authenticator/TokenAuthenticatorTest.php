<?php
namespace App\Tests\Authenticator;

use App\Authenticator\TokenAuthenticator;
use App\Entity\User;
use App\Service\UserService;
use Doctrine\ORM\NoResultException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class TokenAuthenticatorTest extends TestCase
{
    /**
     * @var TokenAuthenticator
     */
    private TokenAuthenticator $tokenAuthenticator;

    public function setUp(): void
    {
        $this->tokenAuthenticator = new TokenAuthenticator($this->createMock(UserService::class));
    }

    public function testInstanceOfAbstractAuthenticator(): void
    {
        $this->assertInstanceOf(AbstractAuthenticator::class, $this->tokenAuthenticator);
    }

    /**
     * @return array
     */
    public function validRequestProvider(): array
    {
        return [
            'with X-AUTH-TOKEN' => [
                Request::create('', 'GET', [], [], [], ['HTTP_X-AUTH-TOKEN' => 'token']),
                true
            ],
            'without X-AUTH-TOKEN' => [Request::create(''), false]
        ];
    }

    /**
     * @param Request $request
     * @param bool $expected
     *
     * @dataProvider validRequestProvider
     */
    public function testSupports(Request $request, bool $expected): void
    {
        $this->assertSame($expected, $this->tokenAuthenticator->supports($request));
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function validAuthenticateProvider(): array
    {
        $token = bin2hex(random_bytes(32));
        return [
            'random request' => [
                Request::create('', 'GET', [], [], [], ['HTTP_X-AUTH-TOKEN' => $token]),
                $token
            ]
        ];
    }

    /**
     * @param Request $request
     * @param string $token
     *
     * @dataProvider validAuthenticateProvider
     */
    public function testSuccessAuthenticate(Request $request, string $token): void
    {
        $userServiceMock = $this->createMock(UserService::class);
        $userServiceMock->expects($this->once())
            ->method('find')
            ->with($this->equalTo(['token' => $token]), $this->anything(), $this->anything(), $this->anything())
            ->will($this->returnValue([$this->createMock(User::class)]));
        $this->tokenAuthenticator = new TokenAuthenticator($userServiceMock);
        $this->assertInstanceOf(PassportInterface::class, $this->tokenAuthenticator->authenticate($request));
    }

    /**
     * @return array
     */
    public function invalidAuthenticateProvider(): array
    {
        return [
            'empty token' => [Request::create(
                '',
                'GET',
                [],
                [],
                [],
                ['HTTP_X-AUTH-TOKEN' => '']
            ), UnauthorizedHttpException::class],
            'only space token' => [Request::create(
                '',
                'GET',
                [],
                [],
                [],
                ['HTTP_X-AUTH-TOKEN' => str_repeat(' ', rand(1, 64))]
            ), UnauthorizedHttpException::class],
            'token not found' => [Request::create(
                '',
                'GET',
                [],
                [],
                [],
                ['HTTP_X-AUTH-TOKEN' => 'token']
            ), UnauthorizedHttpException::class]
        ];
    }

    /**
     * @param Request $request
     * @param string $expected
     *
     * @dataProvider invalidAuthenticateProvider
     */
    public function testFailureAuthenticate(Request $request, string $expected): void
    {
        $userServiceMock = $this->createMock(UserService::class);
        $userServiceMock->expects($this->once())
            ->method('find')
            ->will($this->throwException(new NoResultException()));
        $this->tokenAuthenticator = new TokenAuthenticator($userServiceMock);
        $this->expectException($expected);
        $this->tokenAuthenticator->authenticate($request);
    }

    public function testOnAuthenticationSuccess(): void
    {
        $this->assertSame(null, $this->tokenAuthenticator->onAuthenticationSuccess(
            Request::createFromGlobals(),
            $this->createMock(TokenInterface::class),
            'default'
        ));
    }

    public function testOnAuthenticationFailure(): void
    {
        $response = $this->tokenAuthenticator->onAuthenticationFailure(
            Request::createFromGlobals(),
            $this->createMock(AuthenticationException::class)
        );
        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }
}