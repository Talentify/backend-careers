<?php


namespace Domain\Jobs\DTOs;


use Core\DTOs\AbstractDTO;

final class AddressDTO extends AbstractDTO
{
    /**
     * Campo uuid
     * @var string|null
     */
    public ?string $id;
    public ?string $street;
    public ?string $city;
    public ?string $state;
    public ?string $state_full;
    public ?string $zip_code;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getStateFull(): string
    {
        return $this->state_full;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zip_code;
    }

    public function toModelArray(): array
    {
        return json_decode(json_encode($this, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
    }
}
