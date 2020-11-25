<?php

namespace Tests\Unit\Domain\Shared;

use Domain\Shared\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function testCreateAddress()
    {
        $address = new Address([
            'street' => 'Av. Maringá',
            'number' => '1874',
            'complement' => null,
            'neighborhood' => 'Zona 07',
            'city' => 'Maringá',
            'state' => 'Paraná',
            'zip_code' => '87066-990'
        ]);

        $this->assertInstanceOf(Address::class, $address);

        $this->assertEquals('Av. Maringá', $address->street);
        $this->assertEquals('1874', $address->number);
        $this->assertNull($address->complement);
        $this->assertEquals('Zona 07', $address->neighborhood);
        $this->assertEquals('Maringá', $address->city);
        $this->assertEquals('Paraná', $address->state);
        $this->assertEquals('87066-990', $address->zip_code);
    }

    public function testCreateAddressWithComplement()
    {
        $address = new Address([
            'street' => 'Av. Maringá',
            'number' => '1874',
            'complement' => 'Pŕoximo ao parque ecológico',
            'neighborhood' => 'Zona 07',
            'city' => 'Maringá',
            'state' => 'Paraná',
            'zip_code' => '87066-990'
        ]);

        $this->assertInstanceOf(Address::class, $address);

        $this->assertEquals('Av. Maringá', $address->street);
        $this->assertEquals('1874', $address->number);
        $this->assertEquals('Pŕoximo ao parque ecológico', $address->complement);
        $this->assertEquals('Zona 07', $address->neighborhood);
        $this->assertEquals('Maringá', $address->city);
        $this->assertEquals('Paraná', $address->state);
        $this->assertEquals('87066-990', $address->zip_code);
    }
}
