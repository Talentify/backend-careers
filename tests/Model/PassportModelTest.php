<?php
namespace App\Tests\Model;

use App\Entity\User;
use App\Model\PassportModel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\BadgeInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class PassportModelTest extends TestCase
{
    /**
     * @var PassportModel
     */
    private PassportModel $passport;

    public function setUp(): void
    {
        $this->passport = new PassportModel($this->createMock(User::class));
    }

    public function testInstanceOfPassportInterface(): void
    {
        $this->assertInstanceOf(PassportInterface::class, $this->passport);
    }

    public function testGetUser(): void
    {
        $this->assertInstanceOf(User::class, $this->passport->getUser());
    }

    public function testAddbadgeNotImplemented(): void
    {
        $this->expectException(\BadFunctionCallException::class);
        $this->passport->addBadge($this->createMock(BadgeInterface::class));
    }

    public function testHasBadgeNotImplemented(): void
    {
        $this->expectException(\BadFunctionCallException::class);
        $this->passport->hasBadge('');
    }

    public function testGetBadgeNotImplemented(): void
    {
        $this->expectException(\BadFunctionCallException::class);
        $this->passport->getBadge('');
    }

    public function testCheckIfCompletelyResolvedNotImplemented(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->passport->checkIfCompletelyResolved();
    }
}