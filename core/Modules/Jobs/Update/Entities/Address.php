<?php

namespace Recruitment\Modules\Jobs\Update\Entities;

class Address
{
    private $address;
    private $number;
    private $city;
    private $state;
    private $country;
    private $complement;
    private $jobId;

    public function __construct(
        string $address,
        int $number,
        string $city,
        string $state,
        string $country,
        string $complement = null
    ) {
        $this->address = $address;
        $this->number = $number;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->complement = $complement;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function getJobId(): int
    {
        return $this->jobId;
    }

    public function setJobId($jobId): self
    {
        $this->jobId = $jobId;
        return $this;
    }
}
