<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'image'
    ];

    // equipes
    function equipes()
    {
        return $this->hasMany(Equipe::class);
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
    // classement
    function Classements()
    {
        return $this->hasMany(Classement::class);
    }
}
