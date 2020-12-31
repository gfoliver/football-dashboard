<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function seasonStandings()
    {
        return $this->hasMany('App\Core\Entities\SeasonStanding');
    }
}
