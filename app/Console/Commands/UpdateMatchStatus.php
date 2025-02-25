<?php

namespace App\Console\Commands;

use App\Models\Classement;
use App\Models\Matche;
use App\Models\Resultat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PDO;

class UpdateMatchStatus extends Command
{
    protected $signature = 'matches:update-status';
    protected $description = 'Update match statuses and generate scores automatically';

    public function handle()
    {
        try {
            // Update to 'in progress'
            $startingMatches = Matche::where('statut', 'pending')
                ->where('date_matche', '<=', now())
                ->get();

            foreach ($startingMatches as $match) {
                $match->update(['statut' => 'in progress']);
                $match->resultat()->updateOrCreate(
                    ['matche_id' => $match->id],
                    [
                        'score_equipe1' => 0,
                        'score_equipe2' => 0
                    ]
                );
                Log::info("Match #{$match->id} started");
            }

            // Update to 'completed' and generate scores
            $endingMatches = Matche::where('statut', 'in progress')
                ->where('date_matche', '<=', now()->subMinutes(5))
                ->get();

            foreach ($endingMatches as $match) {
                $match->update(['statut' => 'completed']);
                $score1 = rand(0, 10);
                $score2 = rand(0, 10);

                $match->resultat()->updateOrCreate(
                    ['matche_id' => $match->id],
                    [
                        'score_equipe1' => $score1,
                        'score_equipe2' => $score2
                    ]
                );

                // sport
                $sport = $match->sport;
                // equipe 1
                $equipe1 = $match->equipe1;
                // equipe 2
                $equipe2 = $match->equipe2;

                // edit informations equipe 1 en classement
                $classement_equipe1 = Classement::where('equipe_id', $equipe1->id)->where('sport_id', $sport->id)->first();
                // edit informations equipe 2 en classement
                $classement_equipe2 = Classement::where('equipe_id', $equipe2->id)->where('sport_id', $sport->id)->first();

                if ($score1 > $score2) {
                    // equipe 1 win
                    $classement_equipe1->points += 3;
                    $classement_equipe1->vics += 1;
                    // equipe 2 lose
                    $classement_equipe2->los += 1;
                } elseif ($score1 < $score2) {
                    // equipe 2 win
                    $classement_equipe2->points += 3;
                    $classement_equipe2->vics += 1;
                    // equipe 1 lose
                    $classement_equipe1->los += 1;
                } else {
                    $classement_equipe1->points += 1;
                    $classement_equipe1->nuls += 1;

                    $classement_equipe2->points += 1;
                    $classement_equipe2->nuls += 1;
                }

                $classement_equipe1->save();
                $classement_equipe2->save();

                Log::info("Match #{$match->id} completed with scores: {$score1} - {$score2}");
            }

            $this->info("Updated {$startingMatches->count()} matches to 'in progress'");
            $this->info("Completed {$endingMatches->count()} matches with scores");
        } catch (\Exception $e) {
            Log::error("Error updating match statuses: " . $e->getMessage());
            $this->error($e->getMessage());
            return 1;
        }

        return 0;
    }
}
