<?php

namespace App\Domain\JobOpening\Entity\Embeddable;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
class Money
{
    /** @ORM\Column(type="float") */
    public $amount;

    /** @ORM\Column(type="string") */
    public $currency;

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency): void
    {
        $this->currency = $currency;
    }
}