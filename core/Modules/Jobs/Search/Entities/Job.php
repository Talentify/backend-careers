<?php

namespace Recruitment\Modules\Jobs\Search\Entities;

class Job
{
    private $id;
    private $tittle;
    private $description;
    private $status;
    private $address;
    private $salary;
    private $keywords;
    private $recruiterId;

    public function __construct(
        int $id,
        string $tittle,
        string $description,
        string $status,
        Address $address,
        float $salary,
        string $keywords,
        int $recruiterId = null
    ) {
        $this->id = $id;
        $this->tittle = $tittle;
        $this->description = $description;
        $this->status = $status;
        $this->address = $address;
        $this->salary = $salary;
        $this->keywords = $keywords;
        $this->recruiterId = $recruiterId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getTittle(): string
    {
        return $this->tittle;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getKeywords(): string
    {
        return $this->keywords;
    }

    public function getRecruiterId(): ?int
    {
        return $this->recruiterId;
    }
}
