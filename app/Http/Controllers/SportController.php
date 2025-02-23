<?php

namespace App\Http\Controllers;

use App\Models\Classement;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sports = Sport::all();
        return view('sports.index', compact('sports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:sports',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sports', 'public');
            $validated['image'] = $imagePath;
        }

        Sport::create($validated);

        return redirect()->route('sports.index')
            ->with('success', 'Sport créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sport $sport)
    {
        $classements = Classement::where('sport_id', $sport->id)
            ->orderBy('points', 'desc')
            ->with('equipe')
            ->get();

        $matches = $sport->matches()
            ->with(['equipe1', 'equipe2', 'resultat'])
            ->latest('date_matche')
            ->take(5)
            ->get();

        return view('sports.show', compact('sport', 'classements', 'matches'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sport $sport)
    {
        return view('sports.edit', compact('sport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sport $sport)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:sports,nom,' . $sport->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($sport->image) {
                Storage::disk('public')->delete($sport->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('sports', 'public');
            $validated['image'] = $imagePath;
        }

        $sport->update($validated);

        return redirect()->route('sports.index')
            ->with('success', 'Sport mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sport $sport)
    {
        // Delete image if exists
        if ($sport->image) {
            Storage::disk('public')->delete($sport->image);
        }

        $sport->delete();

        return redirect()->route('sports.index')
            ->with('success', 'Sport supprimé avec succès.');
    }
}
