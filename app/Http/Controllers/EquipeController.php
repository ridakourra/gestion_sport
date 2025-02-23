<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Equipe::query()
            ->with(['sport'])
            ->withCount('joueurs');

        // Search by name
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        // Filter by sport
        if ($request->filled('sport')) {
            $query->where('sport_id', $request->sport);
        }

        $equipes = $query->latest()->paginate(5);
        $sports = Sport::all();

        return view('equipes.index', compact('equipes', 'sports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sports = Sport::all();
        return view('equipes.create', compact('sports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'sport_id' => 'required|exists:sports,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('equipes', 'public');
        }

        // Create the team
        Equipe::create($validated);

        // Redirect with success message
        return redirect()
            ->route('equipes.index')
            ->with('success', 'Équipe créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipe $equipe)
    {
        // Load relationships and counts
        $equipe->load(['sport', 'joueurs' => function ($query) {
            $query->latest()->take(5);
        }, 'matches' => function ($query) {
            $query->with(['equipe1', 'equipe2', 'resultat'])
                ->latest('date_matche')
                ->take(5);
        }]);

        $joueurs = $equipe->joueurs;
        $matches = $equipe->matches;
        $classement = $equipe->classements()
            ->with('sport')
            ->first();

        return view('equipes.show', compact('equipe', 'joueurs', 'matches', 'classement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipe $equipe)
    {
        $sports = Sport::all();
        return view('equipes.edit', compact('equipe', 'sports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipe $equipe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'sport_id' => 'required|exists:sports,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($equipe->logo) {
                Storage::disk('public')->delete($equipe->logo);
            }

            // Store new logo
            $validated['logo'] = $request->file('logo')->store('equipes', 'public');
        }

        $equipe->update($validated);

        return redirect()
            ->route('equipes.index')
            ->with('success', 'Équipe mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        //
    }
}
