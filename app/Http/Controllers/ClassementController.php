<?php

namespace App\Http\Controllers;

use App\Models\Classement;
use App\Models\Equipe;
use App\Models\Sport;
use Illuminate\Http\Request;

class ClassementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Classement::with(['sport', 'equipe']);

        // تصفية حسب الرياضة إذا تم تمرير معامل sport
        if ($request->has('sport')) {
            $sportName = $request->input('sport');
            $query->whereHas('sport', function ($q) use ($sportName) {
                $q->where('nom', $sportName);
            });
        }

        $classements = $query->get();

        return view('classements.index', compact('classements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sports = Sport::all();
        $equipes = Equipe::all();
        return view('classements.create', compact('sports', 'equipes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sport_id' => 'required|exists:sports,id',
            'equipe_id' => 'required|exists:equipes,id',
            'points' => 'required|integer',
            'rang' => 'required|integer',
        ]);

        Classement::create($request->all());

        return redirect()->route('classements.index')->with('success', 'Classement created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classement $classement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classement $classement)
    {
        $sports = Sport::all();
        $equipes = Equipe::all();
        return view('classements.edit', compact('classement', 'sports', 'equipes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classement $classement)
    {
        $request->validate([
            'sport_id' => 'required|exists:sports,id',
            'equipe_id' => 'required|exists:equipes,id',
            'points' => 'required|integer',
            'rang' => 'required|integer',
        ]);

        $classement->update($request->all());

        return redirect()->route('classements.index')->with('success', 'Classement updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classement $classement)
    {
        $classement->delete();
        return redirect()->route('classements.index')->with('success', 'Classement deleted successfully!');
    }
}
