<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo'
    ];

    public function seasonStandings()
    {
        return $this->hasMany('App\Core\Entities\SeasonStanding');
    }

    public function getLogoAttribute($value)
    {
        if (is_null($value))
            return NULL;
        
        return Storage::disk('teams')->url($value);
    }

}
