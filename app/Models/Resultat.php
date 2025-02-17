<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Matche;

class Resultat extends Model
{

    protected $fillable = [
        'match_id',
        'score_equipe1',
        'score_equipe2'
    ];


    function Match(){
        return $this->hasOne(Matche::class);
    }


}
