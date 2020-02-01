<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'workplace',
        'salary',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getSalaryAttribute()
    {
        if($this->attributes['salary'] === null){
            return null;
        }

        return number_format($this->attributes['salary'], 2, '.', '');
    }

    public function getWorkplaceAttribute()
    {
        if($this->attributes['workplace'] === null){
            return null;
        }

        return json_decode($this->attributes['workplace'], true);
    }

    public function setWorkplaceAttribute($value)
    {
        $this->attributes['workplace'] = ($value !== null) ? json_encode($value) : $value;

        return json_encode($value);
    }
}
