<?php

namespace Recruitment\Modules\Recruiters\Login\Entities;

class Recruiter
{
    private $email;
    private $token;

    public function __construct(string $email, string $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
