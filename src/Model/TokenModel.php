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
        return [
            'username' => $this->getUsername(),
            'token' => $this->getUserModel()->getToken()
        ];
    }

    /**
     * @return User
     */
    private function getUserModel(): User
    {
        return $this->getUser();
    }
}