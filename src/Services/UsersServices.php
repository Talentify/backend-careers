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
            'exp' => time() + 60,
        ];

        $json = [
            'token' => JWT::encode($payload, Security::getSalt(), 'HS256'),
        ];

        return $json;
    }
}
