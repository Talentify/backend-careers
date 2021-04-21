<?php

namespace App\Models;

use App\Enums\MatchScoreEnum;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    protected $table = 'recruiters';
    protected $fillable = ['name', 'birth', 'cpf', 'company', 'address', 'user_id'];
    protected $dates = ['birth'];
    const RECORDS_PER_PAGE = 10;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
