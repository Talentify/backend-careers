<?php


namespace Domain\Jobs\DTOs;


use Core\DTOs\AbstractDTO;

final class JobDTO extends AbstractDTO
{
    /**
     * Campo uuid
     * @var string|null
     */
    public ?string $id;
    public string $title;
    public ?string $description;
    /**@var int */
    public ?int $status;
    /**@var float|int */
    public $salary;
    public ?AddressDTO $address;


    public function toModelArray(): array
    {
        return $this->toArray();
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
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return AbstractDTO|null
     */
    public function getAddress(): ?AbstractDTO
    {
        return $this->address;
    }
}
