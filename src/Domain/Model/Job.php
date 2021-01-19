<?php

namespace App\Domain\Model;

use App\Domain\Enum\Job\StatusEnum;

class Job
{

    private int $id;
    private string $title;
    private string $description;
    private int $status;
    private ?string $workplace;
    private ?float $salary;

    public function __construct()
    {
        $this->title = '';
        $this->description = '';
        $this->status = StatusEnum::OPEN;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getWorkplace(): ?string
    {
        return $this->workplace;
    }

    /**
     * @param string|null $workplace
     */
    public function setWorkplace(?string $workplace): void
    {
        $this->workplace = $workplace;
    }

    /**
     * @return float|null
     */
    public function getSalary(): ?float
    {
        return $this->salary;
    }

    /**
     * @param float|null $salary
     */
    public function setSalary(?float $salary): void
    {
        $this->salary = $salary;
    }

}