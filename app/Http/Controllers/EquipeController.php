<?php

namespace App\Http\Controllers;

use App\Models\Classement;
use App\Models\Equipe;
use App\Models\Sport;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('equipes.index', ['equipes' => Equipe::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipes.create',['sports' => Sport::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vars = $request->validate([
            'nom' => ['required', 'min:2', 'max:50'],
            'sport_id' => ['required']
        ]);
        $equipe = Equipe::create($vars);
        Classement::create([
            'sport_id' => $equipe->sport_id,
            'equipe_id' => $equipe->id,
            'points' => 0,
            'rang' => Equipe::count()
        ]);
        return redirect()->route('equipes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipe $equipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipe $equipe)
    {
        return view('equipes.edit', ['equipe' => $equipe, 'sports' => Sport::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipe $equipe)
    {
        $vars = $request->validate([
            'nom' => ['required', 'min:2', 'max:50'],
            'sport_id' => ['required']
        ]);
        $equipe->update($vars);
        $equipe->save();
        return redirect()->route('equipes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        $equipe->delete();
        return redirect()->route('equipes.index');
    }
}
