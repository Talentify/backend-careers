<?php
namespace App\Tests\Entity;

use App\Entity\User;
use App\Exceptions\EmptyException;
use App\Exceptions\InvalidPasswordHashException;
use App\Interfaces\DoctrineEntityInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    private User $user;

    public function setUp(): void
    {
        $this->user = new User();
    }

    public function testInstanceOfDoctrineEntityInterface(): void
    {
        $this->assertInstanceOf(DoctrineEntityInterface::class, $this->user);
    }

    public function testInstanceOfUserInterface(): void
    {
        $this->assertInstanceOf(UserInterface::class, $this->user);
    }

    /**
     * @return array
     */
    public function validUsernameProvider(): array
    {
        $username = str_repeat('a', rand(1, 100));
        return [
            'random username' => [$username, $username]
        ];
    }

    /**
     * @return array
     */
    public function invalidUsernameProvider(): array
    {
        return [
            'empty username' => ['', EmptyException::class],
            'only space string' => [str_repeat(' ', rand(1, 100)), EmptyException::class]
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider validUsernameProvider
     */
    public function testSuccessUsernameGetterAndSetter($value, $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'Username');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidUsernameProvider
     */
    public function testFailureSetUsername($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'Username');
    }

    /**
     * @return array
     */
    public function validPasswordProvider(): array
    {
        $randomPasswordHash = password_hash(str_repeat('a', rand(1, 72)), PASSWORD_BCRYPT);
        return [
            'bcrypt hash of a random password with up to 72 characters' => [$randomPasswordHash, $randomPasswordHash]
        ];
    }

    /**
     * @return array
     */
    public function invalidPasswordProvider(): array
    {
        return [
            'empty password' => ['', EmptyException::class],
            'only space string' => [str_repeat(' ', rand(1, 60)), EmptyException::class],
            'not a bcrypt hash' => [str_repeat('a', rand(1, 60)), InvalidPasswordHashException::class]
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider validPasswordProvider
     */
    public function testSuccessPasswordGetterAndSetter($value, $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'Password');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidPasswordProvider
     */
    public function testFailureSetPassword($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'Password');
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function validTokenProvider(): array
    {
        $token = bin2hex(random_bytes(32));
        return [
            'random token' => [$token, $token],
            'null token' => [null, null]
        ];
    }

    public function invalidTokenProvider(): array
    {
        return [
            'empty string token' => ['', EmptyException::class],
            'only space string' => [str_repeat(' ', rand(1, 64)), EmptyException::class]
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider validTokenProvider
     */
    public function testSuccessTokenGetterAndSetter($value, $expected): void
    {
        $this->assertSuccessGettersAndSetters($value, $expected, 'Token');
    }

    /**
     * @param $value
     * @param string $expected
     *
     * @dataProvider invalidTokenProvider
     */
    public function testFailureSetToken($value, string $expected): void
    {
        $this->assertFailureSetters($value, $expected, 'Token');
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function validJsonProvider(): array
    {
        $randomPassword = password_hash(str_repeat('a', rand(1, 72)), PASSWORD_BCRYPT);
        $randomToken = bin2hex(random_bytes(32));
        $completeData = [
            'username' => 'username',
            'password' => $randomPassword,
            'token' => $randomToken
        ];
        return [
            'complete data' => [$completeData, ['username' => 'username', 'token' => $randomToken]],
            'without token' => [
                array_merge($completeData, ['token' => null]),
                ['username' => 'username', 'token' => null]
            ]
        ];
    }

    /**
     * @param $values
     * @param $expected
     *
     * @dataProvider validJsonProvider
     */
    public function testJsonSerialize($values, $expected): void
    {
        foreach ($values as $variable => $value) {
            $setMethod = 'set' . ucfirst($variable);
            $this->user->$setMethod($value);
        }
        $json = $this->user->jsonSerialize();
        $this->assertIsArray($json);
        foreach ($expected as $key => $value) {
            $this->assertArrayHasKey($key, $json);
            $this->assertSame($value, $json[$key]);
        }
    }

    public function testGetRoles(): void
    {
        $this->assertIsArray($this->user->getRoles());
    }

    public function testGetSalt(): void
    {
        $this->assertNull($this->user->getSalt());
    }

    public function testEraseCredentials(): void
    {
        $this->assertNull($this->user->eraseCredentials());
    }

    /**
     * @param $value
     * @param $expected
     * @param string $variable
     */
    private function assertSuccessGettersAndSetters($value, $expected, string $variable): void
    {
        $setMethod = 'set' . ucfirst($variable);
        $getMethod = 'get' . ucfirst($variable);
        $this->assertInstanceOf(User::class, $this->user->$setMethod($value));
        $this->assertSame($expected, $this->user->$getMethod());
    }

    /**
     * @param $value
     * @param $expected
     * @param string $variable
     */
    private function assertFailureSetters($value, $expected, string $variable): void
    {
        $setMethod = 'set' . ucfirst($variable);
        $this->expectException($expected);
        $this->user->$setMethod($value);
    }
}