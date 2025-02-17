<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Equipe;
use App\Models\Sport;

class Classement extends Model
{

    protected $fillable = [
        'sport_id',
        'equipe_id',
        'points',
        'rang'
    ];

    function sport(){
        return $this->belongsTo(Sport::class);
    }
    function equipe(){
        return $this->belongsTo(Equipe::class);
    }
    
}
