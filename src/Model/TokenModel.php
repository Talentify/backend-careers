<?php
namespace App\Model;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class TokenModel extends AbstractToken
{
    /**
     * @return mixed|string
     */
    public function getCredentials()
    {
        return $this->getUserModel()->jsonSerialize();
    }

    /**
     * @return User
     */
    private function getUserModel(): User
    {
        return $this->getUser();
    }
}