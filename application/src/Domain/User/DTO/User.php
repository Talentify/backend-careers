<?php

namespace App\Domain\User\DTO;

use App\Infra\Request\UserRequest;

class User
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $email;

    private function __construct(array $request)
    {
        $this->name = $request['name'];
        $this->username = $request['username'];
        $this->password = $request['password'];
        $this->email = $request['email'];
    }

    public static function fromRequest(UserRequest $request)
    {
        return new self([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email
        ]);
    }

}