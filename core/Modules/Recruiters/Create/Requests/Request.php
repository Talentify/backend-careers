<?php

namespace Recruitment\Modules\Recruiters\Create\Requests;

class Request
{
    private $name;
    private $cpf;
    private $companyId;
    private $email;
    private $password;

    public function __construct(string $name, string $cpf, int $companyId, string $email, string $password)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->companyId = $companyId;
        $this->email = $email;
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
