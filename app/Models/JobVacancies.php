<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancies extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'workplace',
        'salary',
    ];

    public function getSalaryAttribute($value)
    {
        $value = 'R$ '.number_format($value, 2, ',', '.');
        return $this->attributes['salary'] = $value;
    }
}
