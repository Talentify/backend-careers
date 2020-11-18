<?php
namespace App\Entity;

use App\Interfaces\DoctrineEntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Workplace
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
class Workplace implements DoctrineEntityInterface
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $identifier;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private string $address;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private string $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private string $state;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private string $country;

    /**
     * @return int
     */
    public function getIdentifier(): int
    {
        return $this->identifier;
    }

    /**
     * @param int $identifier
     * @return Workplace
     */
    public function setIdentifier(int $identifier): Workplace
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Workplace
     */
    public function setAddress(string $address): Workplace
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Workplace
     */
    public function setCity(string $city): Workplace
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Workplace
     */
    public function setState(string $state): Workplace
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Workplace
     */
    public function setCountry(string $country): Workplace
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'identifier' => $this->getIdentifier(),
            'address' => $this->getAddress(),
            'city' => $this->getCity(),
            'state' => $this->getState(),
            'country' => $this->getCountry()
        ];
    }
}