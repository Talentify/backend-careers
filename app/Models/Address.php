<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'city',
        'district',
        'number'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
