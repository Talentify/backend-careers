<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $fillable = ['title', 'description', 'status', 'address', 'salary', 'company', 'recruiter_id'];
    protected $casts = [
        'salary' => 'float'
    ];
    const RECORDS_PER_PAGE = 10;

    public function recruiter() {
        return $this->belongsTo(Recruiter::class);
    }
}
