<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
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
