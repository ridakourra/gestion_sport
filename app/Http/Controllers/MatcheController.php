<?php

namespace App\Http\Controllers;

use App\Models\Matche;
use App\Models\Sport;
use App\Models\Equipe;
use App\Models\Resultat;
use App\Models\User;
use App\Notifications\NewMatchScheduled;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MatcheController extends Controller
{
    public function index(Request $request)
    {
        $query = Matche::query()
            ->with(['sport', 'equipe1', 'equipe2', 'resultat']);

        // Filter by status
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filter by team
        if ($request->filled('equipe')) {
            $query->where(function ($q) use ($request) {
                $q->where('equipe1_id', $request->equipe)
                    ->orWhere('equipe2_id', $request->equipe);
            });
        }

        // Filter by sport
        if ($request->filled('sport')) {
            $query->where('sport_id', $request->sport);
        }

        // Filter by date range
        if ($request->filled('date_begin')) {
            $query->whereDate('date_matche', '>=', $request->date_begin);
        }
        if ($request->filled('date_end')) {
            $query->whereDate('date_matche', '<=', $request->date_end);
        }

        // sort by nom and age and sport and equipe
        if ($request->filled('sort')) {
            $column = explode('-', $request->sort)[0];
            $direction = explode('-', $request->sort)[1];
            switch ($column) {
                case 'sport':
                    $query->orderBy(Sport::select('nom')->whereColumn('sports.id', 'matches.sport_id', $direction));
                    break;
                default:
                    $query->orderBy($column, $direction);
                    break;
            }
        }

        $matches = $query->orderBy('date_matche', 'desc')->paginate(10);
        $sports = Sport::all();
        $equipes = Equipe::all();

        return view('matches.index', compact('matches', 'sports', 'equipes'));
    }

    public function create()
    {
        $sports = Sport::all();
        $equipes = Equipe::all();
        return view('matches.create', compact('sports', 'equipes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sport_id' => 'required|exists:sports,id',
            'equipe1_id' => 'required|exists:equipes,id',
            'equipe2_id' => 'required|exists:equipes,id|different:equipe1_id',
            'date_matche' => 'required|date|after:now',
            'lieu' => 'required|string|max:255',
        ]);

        $matche = Matche::create($validated);

        // Only create result if scores are provided
        if ($request->filled(['score_equipe1', 'score_equipe2'])) {
            $resultat = new Resultat([
                'score_equipe1' => $request->score_equipe1,
                'score_equipe2' => $request->score_equipe2
            ]);
            $matche->resultat()->save($resultat);
        }

        $matche->load(['sport', 'equipe1', 'equipe2']);

        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewMatchScheduled($matche));
        }


        return redirect()
            ->route('matches.index')
            ->with('success', 'Match créé avec succès.');
    }

    public function show(Matche $match)
    {
        $match->load(['sport', 'equipe1', 'equipe2', 'resultat']);
        return view('matches.show', compact('match'));
    }

    public function edit(Matche $match)
    {
        $sports = Sport::all();
        $equipes = Equipe::all();
        return view('matches.edit', compact('match', 'sports', 'equipes'));
    }

    public function update(Request $request, Matche $match)
    {
        $validated = $request->validate([
            'sport_id' => 'required|exists:sports,id',
            'equipe1_id' => 'required|exists:equipes,id',
            'equipe2_id' => 'required|exists:equipes,id|different:equipe1_id',
            'date_matche' => 'required|date',
            'lieu' => 'required|string|max:255',
        ]);

        $match->update($validated);

        // Only update result if scores are provided
        if ($request->filled(['score_equipe1', 'score_equipe2'])) {
            $match->resultat()->updateOrCreate(
                ['matche_id' => $match->id],
                [
                    'score_equipe1' => $request->score_equipe1,
                    'score_equipe2' => $request->score_equipe2
                ]
            );
        }

        return redirect()
            ->route('matches.index')
            ->with('success', 'Match mis à jour avec succès.');
    }

    public function destroy(Matche $match)
    {
        $match->delete();
        return redirect()
            ->route('matches.index')
            ->with('success', 'Match supprimé avec succès.');
    }
}
