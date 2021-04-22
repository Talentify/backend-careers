<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_recruiters_creator',
        'title', 
        'description', 
        'status', 
        'address', 
        'salary', 
        'company'
    ];

    public function recruiter() {
        return $this->belongsTo(Recruiter::class);
    }
}
