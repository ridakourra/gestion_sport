<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use App\Models\Sport;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $totalTeams = Equipe::count();
        $totalPlayers = Joueur::count();
        $upcomingMatches = Matche::where('statut', 'upcoming')->count();
        $totalSports = Sport::count();
        // $recentMatches = Matche::with(['Equipe1', 'Equipe2', 'Resultat'])
        //                     ->where('statut','=','Terminé')
        //                     ->orderBy('date_match', 'desc')
        //                     ->take(5)
        //                     ->get();

        return view('dashboard', compact('totalTeams', 'totalPlayers', 'upcomingMatches', 'totalSports'));
    }
}
