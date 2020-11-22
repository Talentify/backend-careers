<?php
namespace App\Tests\Authenticator;

use App\Authenticator\TokenAuthenticator;
use App\Entity\User;
use App\Model\PassportModel;
use App\Service\UserService;
use Doctrine\ORM\NoResultException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
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

    public function testInstanceOfAuthenticatorInterface(): void
    {
        $this->assertInstanceOf(AuthenticatorInterface::class, $this->tokenAuthenticator);
    }

    /**
     * @return array
     */
    public function validSupportsRequestProvider(): array
    {
        return [
            'with X-AUTH-TOKEN' => [
                Request::create('', 'GET', [], [], [], ['HTTP_X-AUTH-TOKEN' => 'token']),
                true
            ],
            'without X-AUTH-TOKEN' => [Request::createFromGlobals(), false]
        ];
    }

    /**
     * @param Request $request
     * @param bool $expected
     *
     * @dataProvider validSupportsRequestProvider
     */
    public function testSupports(Request $request, bool $expected): void
    {
        $this->assertSame($expected, $this->tokenAuthenticator->supports($request));
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function requestAuthenticateProvider(): array
    {
        $token = bin2hex(random_bytes(32));
        return [
            'random credential' => [
                Request::create('', 'GET', [], [], [], ['HTTP_X-AUTH-TOKEN' => $token]),
                $token
            ]
        ];
    }

    /**
     * @param Request $request
     * @param string $token
     *
     * @dataProvider requestAuthenticateProvider
     */
    public function testSuccessAuthenticate(Request $request, string $token): void
    {
        $userServiceMock = $this->createMock(UserService::class);
        $userServiceMock->expects($this->once())
            ->method('find')
            ->with(['token' => $token], $this->anything(), $this->anything(), $this->anything())
            ->will($this->returnValue([$this->createMock(User::class)]));
        $this->tokenAuthenticator = new TokenAuthenticator($userServiceMock);
        $this->assertInstanceOf(PassportInterface::class, $this->tokenAuthenticator->authenticate($request));
    }

    /**
     * @param Request $request
     * @param string $token
     *
     * @dataProvider requestAuthenticateProvider
     */
    public function testFailureAuthenticate(Request $request, string $token): void
    {
        $userServiceMock = $this->createMock(UserService::class);
        $userServiceMock->expects($this->once())
            ->method('find')
            ->with(['token' => $token], $this->anything(), $this->anything(), $this->anything())
            ->will($this->throwException(new NoResultException()));
        $this->tokenAuthenticator = new TokenAuthenticator($userServiceMock);
        $this->expectException(UnauthorizedHttpException::class);
        $this->tokenAuthenticator->authenticate($request);
    }

    public function testSuccessCreateAuthenticatedToken(): void
    {
        $passport = $this->createMock(PassportModel::class);
        $passport->expects($this->once())
            ->method('getUser')
            ->will($this->returnValue($this->createMock(User::class)));
        $this->assertInstanceOf(
            TokenInterface::class,
            $this->tokenAuthenticator->createAuthenticatedToken($passport, '')
        );
    }

    public function testFailureCreateAuthenticateToken(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->tokenAuthenticator->createAuthenticatedToken($this->createMock(PassportInterface::class), '');
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

    public function testOnAuthenticationSuccess(): void
    {
        $this->assertNull($this->tokenAuthenticator->onAuthenticationSuccess(
            Request::createFromGlobals(),
            $this->createMock(TokenInterface::class),
            ''
        ));
    }
}