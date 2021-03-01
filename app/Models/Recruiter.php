<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    protected $table = 'recruiters';
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'password',
        'company_id'
    ];
}
