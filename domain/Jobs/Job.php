<?php

namespace Domain\Jobs;

use Domain\DomainModel;
use Domain\Shared\Address;

class Job extends DomainModel
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'salary',
    ];

    protected $casts = [
        'salary' => 'double'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function setAddressAttribute(?Address $address)
    {
        return $this->address()->associate($address);
    }
}
