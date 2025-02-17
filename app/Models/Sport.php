<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use App\Models\Classement;

class Sport extends Model
{
    protected $fillable = ['nom', 'description'];


    function Equipes(){
        return $this->hasMany(Equipe::class);
    }
    function Joueurs(){
        return $this->hasMany(Joueur::class);
    }
    function Matches(){
        return $this->hasMany(Matche::class);
    }
    public function Classement()
    {
        return $this->hasOne(Classement::class); 
    }


}
