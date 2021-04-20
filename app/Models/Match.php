<?php

namespace App\Models;

use App\Enums\MatchScoreEnum;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    const RECORDS_PER_PAGE = 10;
    protected $table = 'matches';
    protected $fillable = ['date', 'start_time', 'end_time', 'home_team_id', 'visitor_team_id', 'home_team_score',
        'visitor_team_score'];
    protected $dates = ['date'];

    public function homeTeam() {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function visitorTeam() {
        return $this->belongsTo(Team::class, 'visitor_team_id');
    }

    public function goals() {
        return $this->hasMany(Goal::class);
    }

    public function cards() {
        return $this->hasMany(Card::class);
    }
}
