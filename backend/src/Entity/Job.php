<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="StatusType")
     */
    private $status;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $salary;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, inversedBy="job", cascade={"persist", "remove"})
     */
    private $workspace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(?float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getWorkspace(): ?Address
    {
        return $this->workspace;
    }

    public function setWorkspace(?Address $workspace): self
    {
        $this->workspace = $workspace;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'salary' => $this->getSalary(),
            'status' => $this->getStatus(),
            'workspace' => $this->getWorkspace() //? $this->getWorkspace()->toArray() : null,
        ];
    }
}
