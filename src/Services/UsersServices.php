<?php


namespace App\Services;


use Cake\Http\Exception\BadRequestException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

class UsersServices extends Services
{
    public function login()
    {
        $result = $this->Authentication->getResult();

        if (!$result->isValid()) {
            throw new BadRequestException(__("Incorrect username or password!"));
        }

        $user = $result->getData();
        $payload = [
            'sub' => $user->id,
            'exp' => time() + 600,
        ];

        $json = [
            'token' => JWT::encode($payload, Security::getSalt(), 'HS256'),
        ];

        return $json;
    }

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
