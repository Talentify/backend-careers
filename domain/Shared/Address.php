<?php

namespace Domain\Shared;

use Domain\DomainModel;

class Address extends DomainModel
{
    protected $fillable = [
        'id',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'zip_code',
    ];

    public static function make(array $data = []): ?Address
    {
        if (empty($data['address'])) {
            return null;
        }

        return new Address($data['address']);
    }
}
