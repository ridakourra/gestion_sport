<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


use Illuminate\Support\Facades\Schedule;
use App\Models\Matche;
use App\Models\Resultat;
use Carbon\Carbon;



Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('matches:update-status')->everySecond();

Artisan::command('matches:update-status', function () {
    $matches = Matche::where('statut', 'À venir')->orWhere('statut', 'En cours')->get();

    foreach ($matches as $match) {
        $now = now();
        $matchTime = Carbon::parse($match->date_match);

        if ($now >= $matchTime && $now < $matchTime->copy()->addMinutes(90)) {
            $match->update(['statut' => 'En cours']);
        }

        if ($now >= $matchTime->copy()->addMinutes(90)) {
            $match->update(['statut' => 'Terminé']);

            Resultat::create([
                'match_id' => $match->id,
                'score_equipe1' => rand(0, 50),
                'score_equipe2' => rand(0, 50),
            ]);
        }
    }

    $this->info('Statut of matches are updated!');
})->purpose('Status of matches automaticly updated!');
