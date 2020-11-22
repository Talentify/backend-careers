<?php
namespace App\Tests\Model;

use App\Entity\User;
use App\Model\TokenModel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class TokenModelTest extends TestCase
{
    /**
     * @var TokenModel 
     */
    private TokenModel $tokenModel;
    
    public function setUp(): void
    {
        $this->tokenModel = new TokenModel();
    }
    
    public function testInstanceOfAbstractToken(): void
    {
        $this->assertInstanceOf(AbstractToken::class, $this->tokenModel);
    }

    public function testGetCredentials(): void
    {
        $userMock = $this->createMock(User::class);
        $userMock->expects($this->once())
            ->method('getUsername')
            ->will($this->returnValue('username'));
        $this->tokenModel->setUser($userMock);
        $this->assertSame('username', $this->tokenModel->getCredentials());
    }
}