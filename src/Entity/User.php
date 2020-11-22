<?php
namespace App\Entity;

use App\Exceptions\EmptyException;
use App\Exceptions\InvalidPasswordHashException;
use App\Interfaces\DoctrineEntityInterface;
use App\Traits\EntityValidationTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
class User implements DoctrineEntityInterface, UserInterface
{
    use EntityValidationTrait;

    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private string $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60)
     */
    private string $password;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true, length=64)
     */
    private ?string $token;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     * @throws EmptyException
     */
    public function setUsername(string $username): User
    {
        $this->username = $this->validateEmptyString($username);
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     * @throws EmptyException
     * @throws InvalidPasswordHashException
     */
    public function setPassword(string $password): User
    {
        $this->password = $this->validateBcryptHash($this->validateEmptyString($password));
        return $this;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     * @return User
     * @throws EmptyException
     */
    public function setToken(?string $token): User
    {
        $this->token = (is_null($token) ? $token : $this->validateEmptyString($token));
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'username' => $this->getUsername()
        ];
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return ['ROLE_OK'];
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {}
}