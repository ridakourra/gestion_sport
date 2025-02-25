<?php

namespace App\Http\Controllers;

use App\Models\Joueur;
use App\Models\Sport;
use App\Models\Equipe;
use App\Models\Matche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JoueurController extends Controller
{
    public function index(Request $request)
    {
        $query = Joueur::query()->with(['sport', 'equipe']);

        // search by name
        if ($request->filled('search')) {
            $query->where('nom', 'like', "%$request->search%");
        }

        // search by sport
        if ($request->filled('sport')) {
            $query->where('sport_id', $request->sport);
        }

        // search by Equipe
        if ($request->filled('equipe')) {
            $query->where('equipe_id', $request->equipe);
        }

        // sort by nom and age and sport and equipe
        if ($request->filled('sort')) {
            $column = explode('-', $request->sort)[0];
            $direction = explode('-', $request->sort)[1];
            switch ($column) {
                case 'sport':
                    $query->orderBy(Sport::select('nom')->whereColumn('sports.id', 'joueurs.sport_id', $direction));
                    break;
                case 'equipe':
                    $query->orderBy(Equipe::select('nom')->whereColumn('equipes.id', 'joueurs.equipe_id', $direction));
                    break;
                default:
                    $query->orderBy($column, $direction);
                    break;
            }
        }

        $joueurs = $query->latest()->paginate(5);
        $sports = Sport::all();
        $equipes = Equipe::all();

        return view('joueurs.index', compact('joueurs', 'sports', 'equipes'));
    }

    public function create()
    {
        $sports = Sport::all();
        $equipes = Equipe::all();
        return view('joueurs.create', compact('sports', 'equipes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'sport_id' => 'required|exists:sports,id',
            'equipe_id' => 'required|exists:equipes,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('joueurs', 'public');
        }

        Joueur::create($validated);

        return redirect()
            ->route('joueurs.index')
            ->with('success', 'Joueur créé avec succès.');
    }

    public function show(Joueur $joueur)
    {
        $joueur->load(['sport', 'equipe']);

        // Get recent matches where player's team participated
        $derniers_matches = Matche::where(function ($query) use ($joueur) {
            $query->where('equipe1_id', $joueur->equipe_id)
                ->orWhere('equipe2_id', $joueur->equipe_id);
        })
            ->with(['equipe1', 'equipe2', 'resultat'])
            ->latest('date_matche')
            ->take(5)
            ->get();

        // You might want to add these to your Joueur model to track statistics
        $joueur->matches_count = $derniers_matches->count();
        // Add other statistics as needed

        return view('joueurs.show', compact('joueur', 'derniers_matches'));
    }

    public function edit(Joueur $joueur)
    {
        $sports = Sport::all();
        $equipes = Equipe::all();
        return view('joueurs.edit', compact('joueur', 'sports', 'equipes'));
    }

    public function update(Request $request, Joueur $joueur)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'sport_id' => 'required|exists:sports,id',
            'equipe_id' => 'required|exists:equipes,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($joueur->image) {
                Storage::disk('public')->delete($joueur->image);
            }
            $validated['image'] = $request->file('image')->store('joueurs', 'public');
        }

        $joueur->update($validated);

        return redirect()
            ->route('joueurs.index')
            ->with('success', 'Joueur mis à jour avec succès.');
    }

    public function destroy(Joueur $joueur)
    {
        if ($joueur->image) {
            Storage::disk('public')->delete($joueur->image);
        }

        $joueur->delete();

        return redirect()
            ->route('joueurs.index')
            ->with('success', 'Joueur supprimé avec succès.');
    }
}
