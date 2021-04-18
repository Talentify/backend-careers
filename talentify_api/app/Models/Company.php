<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = ['name'];
    
    public function recruiters() {
        return $this->hasMany(Recruiter::class);
    }
}
