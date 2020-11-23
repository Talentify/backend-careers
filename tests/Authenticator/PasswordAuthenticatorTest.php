<?php
namespace App\Tests\Authenticator;

use App\Authenticator\PasswordAuthenticator;
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

class PasswordAuthenticatorTest extends TestCase
{
    /**
     * @var PasswordAuthenticator
     */
    private PasswordAuthenticator $passwordAuthenticator;

    public function setUp(): void
    {
        $this->passwordAuthenticator = new PasswordAuthenticator($this->createMock(UserService::class));
    }

    public function testInstanceOfAuthenticatorInterface(): void
    {
        $this->assertInstanceOf(AuthenticatorInterface::class, $this->passwordAuthenticator);
    }

    /**
     * @return array
     */
    public function requestSupportsProvider(): array
    {
        return [
            'anything with X-AUTH-TOKEN header' => [
                Request::create('', 'GET', [], [], [], ['HTTP_X-AUTH-TOKEN' => '']),
                false
            ],
            'POST with username, password' => [
                Request::create('', 'POST', [], [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
                    'username' => 'username',
                    'password' => 'password'
                ])),
                true
            ],
            'POST without username' => [
                Request::create('', 'POST', [], [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
                    'password' => 'password'
                ])),
                false
            ],
            'POST without password' => [
                Request::create('', 'POST', [], [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
                    'username' => 'username'
                ])),
                false
            ]
        ];
    }

    /**
     * @param Request $request
     * @param bool $expected
     *
     * @dataProvider requestSupportsProvider
     */
    public function testSupports(Request $request, bool $expected): void
    {
        $this->assertSame($expected, $this->passwordAuthenticator->supports($request));
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function requestAuthenticatorProvider(): array
    {
        $randomString = bin2hex(random_bytes(rand(1, 100)));
        $user = $this->createMock(User::class);
        $user->expects($this->once())
            ->method('getPassword')
            ->will($this->returnValue(password_hash($randomString, PASSWORD_BCRYPT)));
        return [
            'random credential' => [
                Request::create('', 'POST', [], [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
                    'username' => $randomString,
                    'password' => $randomString
                ])),
                ['username' => $randomString],
                $user
            ]
        ];
    }

    /**
     * @param Request $request
     * @param array $credential
     * @param User $user
     *
     * @dataProvider requestAuthenticatorProvider
     */
    public function testSuccessAuthenticate(Request $request, array $credential, User $user): void
    {
        $userServiceMock = $this->createMock(UserService::class);
        $userServiceMock->expects($this->once())
            ->method('find')
            ->with($this->equalTo($credential), $this->anything(), $this->anything(), $this->anything())
            ->will($this->returnValue([$user]));
        $this->passwordAuthenticator = new PasswordAuthenticator($userServiceMock);
        $this->assertInstanceOf(PassportInterface::class, $this->passwordAuthenticator->authenticate($request));
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function invalidRequestAuthenticatorProvider(): array
    {
        $randomString = bin2hex(random_bytes(rand(1, 100)));
        $user = $this->createMock(User::class);
        $user->expects($this->once())
            ->method('getPassword')
            ->will($this->returnValue(password_hash($randomString . 'a', PASSWORD_BCRYPT)));
        return [
            'not found user' => [
                Request::create('', 'POST', [], [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
                    'username' => $randomString,
                    'password' => $randomString
                ])),
                ['username' => $randomString],
                $this->throwException(new NoResultException())
            ],
            'wrong password' => [
                Request::create('', 'POST', [], [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
                    'username' => $randomString,
                    'password' => $randomString
                ])),
                ['username' => $randomString],
                $this->returnValue([$user])
            ]
        ];
    }

    /**
     * @param Request $request
     * @param array $credential
     * @param $will
     *
     * @dataProvider invalidRequestAuthenticatorProvider
     */
    public function testFailureAuthenticate(Request $request, array $credential, $will): void
    {
        $userServiceMock = $this->createMock(UserService::class);
        $userServiceMock->expects($this->once())
            ->method('find')
            ->with($this->equalTo($credential), $this->anything(), $this->anything(), $this->anything())
            ->will($will);
        $this->passwordAuthenticator = new PasswordAuthenticator($userServiceMock);
        $this->expectException(UnauthorizedHttpException::class);
        $this->passwordAuthenticator->authenticate($request);
    }

    public function testSuccessCreateAuthenticatedToken(): void
    {
        $passport = $this->createMock(PassportModel::class);
        $passport->expects($this->once())
            ->method('getUser')
            ->will($this->returnValue($this->createMock(User::class)));
        $this->assertInstanceOf(
            TokenInterface::class,
            $this->passwordAuthenticator->createAuthenticatedToken($passport, '')
        );
    }

    public function testFailureCreateAuthenticateToken(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->passwordAuthenticator->createAuthenticatedToken($this->createMock(PassportInterface::class), '');
    }

    public function testOnAuthenticationFailure(): void
    {
        $response = $this->passwordAuthenticator->onAuthenticationFailure(
            Request::createFromGlobals(),
            $this->createMock(AuthenticationException::class)
        );
        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testOnAuthenticationSuccess(): void
    {
        $this->assertNull($this->passwordAuthenticator->onAuthenticationSuccess(
            Request::createFromGlobals(),
            $this->createMock(TokenInterface::class),
            ''
        ));
    }
}