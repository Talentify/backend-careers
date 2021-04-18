<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'login', 'password'];
    
    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}
