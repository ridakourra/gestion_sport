<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matche extends Model
{
    protected $fillable = [
        'sport_id',
        'equipe1_id',
        'equipe2_id',
        'date_matche',
        'lieu',
        'statut',
    ];


    // sport
    function sport()
    {
        return $this->belongsTo(Sport::class);
    }
    // equipe 1
    function equipe1()
    {
        return $this->belongsTo(Equipe::class, 'equipe1_id');
    }
    // equipe 2
    function equipe2()
    {
        return $this->belongsTo(Equipe::class, 'equipe2_id');
    }
    // resultat
    function resultat()
    {
        return $this->hasOne(Resultat::class);
    }
}
