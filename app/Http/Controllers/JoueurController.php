<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Sport;
use Illuminate\Http\Request;

class JoueurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $joueurs = Joueur::with('sport')->with('equipe')->get();
        return view('joueurs.index', ['joueurs' => $joueurs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('joueurs.create', ['sports' => Sport::all(), 'equipes' => Equipe::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vars = $request->validate([
            'nom' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'sport_id' => ['required', 'exists:sports,id'],
            'equipe_id' => ['nullable', 'exists:equipes,id'],
        ]);
        Joueur::create($vars);
        return redirect()->route('joueurs.index')->with('success', 'Joueur created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Joueur $joueur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Joueur $joueur)
    {
        return view('joueurs.edit', ['joueur' => $joueur,'sports' => Sport::all(), 'equipes' => Equipe::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Joueur $joueur)
    {
        $vars = $request->validate([
            'nom' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'sport_id' => ['required', 'exists:sports,id'],
            'equipe_id' => ['nullable', 'exists:equipes,id'],
        ]);
        $joueur->update($vars);
        $joueur->save();
        return redirect()->route('joueurs.index')->with('success', 'Joueur updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Joueur $joueur)
    {
        $joueur->delete();
        return redirect()->route('joueurs.index')->with('success', 'Joueur deleted successfully!');
    }
}
