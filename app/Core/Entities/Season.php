<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'starts_in',
        'ends_in',
        'active',
        'league_id'
    ];

    public function seasonStanding()
    {
        return $this->hasMany('App\Core\Entities\SeasonStanding');
    }
}
