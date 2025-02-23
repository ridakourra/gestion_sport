<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    protected $fillable = [
        'matche_id',
        'score_equipe1',
        'score_equipe2',
    ];

    // matche
    public function matche()
    {
        return $this->belongsTo(Matche::class);
    }
}
