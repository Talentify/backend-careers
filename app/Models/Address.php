<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'address',
        'number',
        'city',
        'state',
        'country',
        'complement',
        'job_id'
    ];
}
