<?php

namespace Recruitment\Modules\Recruiters\Create\Entities;

class Recruiter
{
    private $name;
    private $cpf;
    private $password;
    private $email;
    private $companyId;

    public function __construct(string $name, string $cpf, string $password, string $email, int $companyId)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->password = $password;
        $this->email = $email;
        $this->companyId = $companyId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }
}
