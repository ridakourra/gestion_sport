<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classement extends Model
{
    protected $fillable = [
        'sport_id',
        'equipe_id',
        'points',
        'rang',
        'vics',
        'los',
        'nuls',
    ];

    // sport
    function sport()
    {
        return $this->belongsTo(Sport::class);
    }
    // equipe
    function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
}
