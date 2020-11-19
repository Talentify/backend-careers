<?php
namespace App\Entity;

use App\Exceptions\EmptyException;
use App\Exceptions\TooLongException;
use App\Interfaces\DoctrineEntityInterface;
use App\Traits\EntityValidationTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Job
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
class Job implements DoctrineEntityInterface
{
    use EntityValidationTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="id")
     */
    private int $identifier;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=256)
     */
    private string $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10000)
     */
    private string $description;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private bool $status;

    /**
     * @var Workplace|null
     *
     * @ORM\OneToOne(targetEntity="Workplace", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Workplace $workplace;

    /**
     * @var float|null
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $salary;

    /**
     * @return int|null
     */
    public function getIdentifier(): ?int
    {
        return $this->identifier ?? null;
    }

    /**
     * @param int $identifier
     * @return Job
     */
    public function setIdentifier(int $identifier): Job
    {
        $this->identifier = $identifier;
        return $this;
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
     * @return Job
     * @throws EmptyException
     * @throws TooLongException
     */
    public function setTitle(string $title): Job
    {
        $this->title = $this->validateMaxLengthString($this->validateEmptyString($title), 256);
        return $this;
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
     * @return Job
     * @throws EmptyException
     * @throws TooLongException
     */
    public function setDescription(string $description): Job
    {
        $this->description = $this->validateMaxLengthString($this->validateEmptyString($description), 10000);
        return $this;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->isStatus();
    }

    /**
     * @param bool $status
     * @return Job
     */
    public function setStatus(bool $status): Job
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Workplace|null
     */
    public function getWorkplace(): ?Workplace
    {
        return $this->workplace;
    }

    /**
     * @param Workplace|null $workplace
     * @return Job
     */
    public function setWorkplace(?Workplace $workplace): Job
    {
        $this->workplace = $workplace;
        return $this;
    }

    /**
     * @return ?float
     */
    public function getSalary(): ?float
    {
        return $this->salary;
    }

    /**
     * @param float|null $salary
     * @return Job
     */
    public function setSalary(?float $salary): Job
    {
        $this->salary = $salary;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'identifier' => $this->getIdentifier(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
            'workplace' => (is_null($this->getWorkplace()) ? null : $this->getWorkplace()->jsonSerialize()),
            'salary' => $this->getSalary()
        ];
    }
}