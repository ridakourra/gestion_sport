<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Matche;
use App\Models\Resultat;
use App\Models\Sport;
use Illuminate\Http\Request;

class MatcheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('matches.index', ['matches' => Matche::with('equipe1', 'equipe2', 'sport')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matches.create', ['sports' => Sport::all(), 'equipes' => Equipe::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vars = $request->validate([
            'sport_id' => ['required'],
            'equipe1_id' => ['required'],
            'equipe2_id' => ['required'],
            'date_match' => ['required', 'date'],
            'lieu' => ['required', 'string', 'max:255', 'min:5']
        ]);
        $match = Matche::create($vars);
        Resultat::create([
            'match_id' => $match->id,
            'score_equipe1' => 0,
            'score_equipe2' => 0
        ]);
        return redirect()->route('matches.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matche $match)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matche $match)
    {
        return view('matches.edit', ['sports' => Sport::all(), 'equipes' => Equipe::all(), 'match' => $match]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matche $match)
    {
        $vars = $request->validate([
            'sport_id' => ['required'],
            'equipe1_id' => ['required'],
            'equipe2_id' => ['required'],
            'date_match' => ['required', 'date'],
            'lieu' => ['required', 'string', 'max:255', 'min:5']
        ]);
        $match->update($vars);
        $match->save();
        return redirect()->route('matches.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matche $match)
    {
        $match->delete();
        return redirect()->route('matches.index');
    }
}
