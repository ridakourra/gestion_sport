<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    protected $fillable = [
        'name',
        'birthday',
        'sport_id',
        'equipe_id',
        'image'
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
