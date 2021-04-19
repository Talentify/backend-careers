<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Recruiter extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'id_company',
        'name',
        'login',
        'password',
    ];

    protected $hidden = [
        'password',
        'api_token',
    ];


    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}
