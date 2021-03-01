<?php

namespace Recruitment\Modules\Jobs\Search\Requests;

class Request
{
    private $keywords;
    private $addressCity;
    private $addressState;
    private $addressCountry;
    private $startSalary;
    private $endSalary;
    private $company;

    public function __construct(
        string $keywords = null,
        string $addressCity = null,
        string $addressState = null,
        string $addressCountry = null,
        float $startSalary = null,
        float $endSalary = null,
        string $company = null
    ) {
        $this->keywords = $keywords;
        $this->addressCity = $addressCity;
        $this->addressState = $addressState;
        $this->addressCountry = $addressCountry;
        $this->startSalary = $startSalary;
        $this->endSalary = $endSalary;
        $this->company = $company;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function getAddressCity(): ?string
    {
        return $this->addressCity;
    }

    public function getAddressState(): ?string
    {
        return $this->addressState;
    }

    public function getAddressCountry(): ?string
    {
        return $this->addressCountry;
    }

    public function getStartSalary(): ?float
    {
        return $this->startSalary;
    }

    public function getEndSalary(): ?float
    {
        return $this->endSalary;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }
}
