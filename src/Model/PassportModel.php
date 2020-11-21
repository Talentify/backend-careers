<?php
namespace App\Model;

use App\Entity\User;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\BadgeInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class PassportModel implements PassportInterface
{
    /**
     * @var User
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param BadgeInterface $badge
     * @return PassportInterface
     */
    public function addBadge(BadgeInterface $badge): PassportInterface
    {
        throw new \BadFunctionCallException();
    }

    /**
     * @param string $badgeFqcn
     * @return bool
     */
    public function hasBadge(string $badgeFqcn): bool
    {
        throw new \BadFunctionCallException();
    }

    /**
     * @param string $badgeFqcn
     * @return BadgeInterface|null
     */
    public function getBadge(string $badgeFqcn): ?BadgeInterface
    {
        throw new \BadFunctionCallException();
    }

    public function checkIfCompletelyResolved(): void
    {
        throw new \BadMethodCallException();
    }

}