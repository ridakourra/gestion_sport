<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Equipe;
use App\Models\Sport;

class Joueur extends Model
{

    protected $fillable = [
        'nom',
        'age',
        'sport_id',
        'equipe_id'
    ];

    function Equipe(){
        return $this->belongsTo(Equipe::class);
    }

    function Sport(){
        return $this->belongsTo(Sport::class);
    }

}
