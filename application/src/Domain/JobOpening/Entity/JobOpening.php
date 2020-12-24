<?php

namespace App\Domain\JobOpening\Entity;

use App\Domain\JobOpening\Entity\Embeddable\Address;
use App\Domain\JobOpening\Entity\Embeddable\Money;
use App\Infra\Repository\JobOpeningRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=App\Infra\Repository\JobOpeningRepository::class)
 */
class JobOpening implements \JsonSerializable, \Serializable
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="text", length=10000, nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=256, nullable=false)
     */
    private $status;

    /**
     * @ORM\Embedded(class="App\Domain\JobOpening\Entity\Embeddable\Address")
     */
    private $workplace;

    /**
     * @ORM\Embedded(class="App\Domain\JobOpening\Entity\Embeddable\Money")
     */
    private $salary;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        if (!in_array($status, array(self::STATUS_ACTIVE, self::STATUS_INACTIVE))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getWorkplace() : Address
    {
        return $this->workplace;
    }

    /**
     * @param mixed $workplace
     */
    public function setWorkplace(Address $workplace): void
    {
        $this->workplace = $workplace;
    }

    /**
     * @return mixed
     */
    public function getSalary() : Money
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary(Money $salary): void
    {
        $this->salary = $salary;
    }

    public function serialize()
    {
    }

    public function unserialize($serialized)
    {
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
            'workplace' => $this->getWorkplace(),
            'salary' => $this->getSalary(),
        ];
    }
}
