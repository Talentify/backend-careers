<?php

namespace Recruitment\Modules\Jobs\Get\Presenters;

use Recruitment\Modules\Jobs\Get\Entities\Address;

class AddressPresenter
{
    private $address;
    private $presenter;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function present(): self
    {
        $this->presenter = [
            'address' => $this->address->getAddress(),
            'number' => $this->address->getNumber(),
            'city' => $this->address->getCity(),
            'state' => $this->address->getState(),
            'country' => $this->address->getCountry(),
            'complement' => $this->address->getComplement()
        ];
        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
