<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use App\Models\Sport;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'nombreEquipes' => Equipe::count(),
            'nombreJoueurs' => Joueur::count(),
            'nombreSports' => Sport::count(),
            'nombreMatches' => Matche::count(),
            'matchesRecents' => Matche::latest()->take(5)->get()
        ]);
    }
}
