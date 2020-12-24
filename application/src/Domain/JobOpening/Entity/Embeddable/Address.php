<?php

namespace App\Domain\JobOpening\Entity\Embeddable;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
class Address
{
    /**
     * @ORM\Column(type="string")
     */
    public $street;

    /**
     * @ORM\Column(type="string")
     */
    public $postalCode;

    /**
     * @ORM\Column(type="string")
     */
    public $city;

    /**
     * @ORM\Column(type="string")
     */
    public $country;

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }
}