<?php 

namespace App\Service;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService {

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;        
    }

}