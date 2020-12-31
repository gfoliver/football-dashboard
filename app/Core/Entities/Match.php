<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'season_id',
        'home_team_id',
        'away_team_id',
        'winner_id',
        'home_team_goals',
        'away_team_goals',
        'result',
    ];

    public function season()
    {
        return $this->belongsTo('App\Core\Entities\Season');
    }

    public function home_team()
    {
        return $this->belongsTo('App\Core\Entities\Team');
    }

    public function away_team()
    {
        return $this->belongsTo('App\Core\Entities\Team');
    }

    public function winner()
    {
        return $this->belongsTo('App\Core\Entities\Team');
    }
}
