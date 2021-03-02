<?php


namespace App\Services;


use Cake\Http\Exception\BadRequestException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

class UsersServices extends Services
{


    public function addUser()
    {

        $this->Request->allowMethod(['POST']);

        $user = $this->Table->newEntity($this->Request->getData());
        $user->status = true;
        $this->Table->save($user);

        if ($user->getErrors()) {
            $return['errors'] = $user->getErrors();
            $this->setResponse($this->Response->withStatus(400));
            return $return;
        }

        $return['user'] = $user;

        return $return;

    }

}
