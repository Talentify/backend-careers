<?php
namespace App\Model;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class TokenModel extends AbstractToken
{
    /**
     * @return mixed|string
     */
    public function getCredentials()
    {
        return $this->getUsername();
    }
}