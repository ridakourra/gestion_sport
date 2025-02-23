<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = [
        'nom',
        'sport_id',
        'logo',
    ];

    // sport
    function sport()
    {
        return $this->belongsTo(Sport::class);
    }
    // joueurs
    function joueurs()
    {
        return $this->hasMany(Joueur::class);
    }
    // matches
    function matches()
    {
        return $this->hasMany(Matche::class);
    }
    // classements
    function classements()
    {
        return $this->hasMany(Classement::class);
    }
}
