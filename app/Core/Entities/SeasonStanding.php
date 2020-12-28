<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonStanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'league_id',
        'team_id',
        'points',
        'matches',
        'wins',
        'draws',
        'losses',
        'goal_difference',
        'goals_scored',
        'goals_conceded',
    ];

    public function team()
    {
        return $this->belongsTo('App\Core\Entities\Team');
    }

    public function season()
    {
        return $this->belongsTo('App\Core\Entities\Season');
    }
}
