<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'title', 'description', 'status', 'address', 'salary', 'company', 'id_recruiter'
    ];
}
