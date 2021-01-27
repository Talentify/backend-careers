<?php

namespace App\Exceptions;

class InvalidLoginException extends \Exception
{
    public function __construct()
    {
        $this->message = 'Usuário ou senha inválidos!';
    }
}
