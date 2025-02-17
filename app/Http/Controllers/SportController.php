<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sports.index', ['sports' => Sport::all()]);
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
        $vars = $request->validate([
            'nom' => ['required','min:3','max:255','unique:sports'],
            'description' => ['nullable'],
        ]);
        Sport::create($vars);
        return redirect()->route('sports.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sport $sport)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sport $sport)
    {
        return view('sports.edit', ['sport' => $sport]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sport $sport)
    {
        $vars = $request->validate([
            'nom' => ['required', 'min:3', 'max:255', 'unique:sports,nom,' . $sport->id],
            'description' => ['nullable'],
        ]);
        $sport->update($vars);
        $sport->save();
        return redirect()->route('sports.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sport $sport)
    {
        $sport->delete();
        return redirect()->route('sports.index');
    }
}
