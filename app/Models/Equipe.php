<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Joueur;
use App\Models\Matche;
use App\Models\Classement;
use App\Models\Sport;

class Equipe extends Model
{
    protected $fillable = [
        'nom',
        'sport_id'
    ];

    function Sport(){
        return $this->belongsTo(Sport::class);
    }

    function Joueurs(){
        return $this->hasMany(Joueur::class);
    }
    
    function Matchs(){
        return $this->hasMany(Matche::class);
    }

    function Classement(){
        return $this->hasOne(Classement::class); 
    }

}
