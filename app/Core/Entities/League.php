<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'cover'
    ];

    public function getLogoAttribute($value) {
        if (is_null($value))
            return NULL;

        return Storage::disk('leagues')->url($value);
    }

    public function getCoverAttribute($value) {
        if (is_null($value))
            return NULL;

        return Storage::disk('leagues')->url($value);
    }
}
