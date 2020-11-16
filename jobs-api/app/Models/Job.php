<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title', 
        'description', 
        'status', 
        'workplace', 
        'salary'
    ];
    public $timestamps = false;
}