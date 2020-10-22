<?php

namespace App\Job\Domain\Entity;

/**
 * Class Job
 * @package App\Job\Domain\Entity
 */
class Job
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $title;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $status = 'on';

    /**
     * @var string|null
     */
    private $workplace;

    /**
     * @var float|null
     */
    private $salary;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Job
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     * @return Job
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return Job
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param null|string $status
     * @return Job
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getWorkplace(): ?string
    {
        return $this->workplace;
    }

    /**
     * @param null|string $workplace
     * @return Job
     */
    public function setWorkplace(?string $workplace): self
    {
        $this->workplace = $workplace;

        return $this;
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
     * @return Job
     */
    public function setSalary(?float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }
}
