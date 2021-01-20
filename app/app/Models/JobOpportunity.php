<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'workplace_id',
        'title',
        'description',
        'status',
        'salary',
        'workplace'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
