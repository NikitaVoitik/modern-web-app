<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elections = Election::with('candidates')
            ->withCount('candidates')
            ->orderBy('election_date', 'desc')
            ->orderBy('candidates_count', 'desc')->get();

        return view('elections.index', compact('elections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('elections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'election_date' => ['required', 'date'],
        ]);

        $election = Election::create([
            'election_date' => $request->election_date,
        ]);

        return redirect()->route('elections.show', $election->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $election = Election::with('candidates')->findOrFail($id);
        $votesMap = $election->getVotesAllCandidates();

        return view('elections.show', compact('election', 'votesMap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $election = Election::findOrFail($id);

        return view('elections.edit', compact('election'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $election = Election::findOrFail($id);
        $election->update($request->only('election_date'));

        return redirect()->route('elections.show', $election->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $election = Election::findOrFail($id);
        $election->delete();

        return redirect()->route('elections.index');
    }
}
