<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use App\Core\Entity;

class Vacancy extends Entity
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $workplace;

    /**
     * @var double
     */
    private $salary;

    /**
     * @var int
     */
    private $status;

    /**
     * Vacancy constructor.
     * @param int $id
     * @param string $title
     * @param string $description
     * @param string $workplace
     * @param float $salary
     * @param int $status
     */
    public function __construct(int $id, string $title, string $description, string $workplace, float $salary, int $status)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->workplace = $workplace;
        $this->salary = $salary;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getWorkplace(): string
    {
        return $this->workplace;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'workplace' => $this->getWorkplace(),
            'salary' => $this->getSalary(),
            'status' => $this->getStatus(),
        ];
    }
}