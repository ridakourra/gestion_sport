<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Sport;
use App\Models\Equipe;
use App\Models\Resultat;

class Matche extends Model
{

    protected $fillable = [
        'sport_id',
        'equipe1_id',
        'equipe2_id',
        'date_match',
        'lieu',
        'statut'
    ];

    function Sport(){
        return $this->belongsTo(Sport::class);
    }

    function Equipe1(){
        return $this->belongsTo(Equipe::class, 'equipe1_id');
    }

    function Equipe2(){
        return $this->belongsTo(Equipe::class, 'equipe2_id');
    }

    function Resultat(){
        return $this->hasOne(Resultat::class);
    }


}
