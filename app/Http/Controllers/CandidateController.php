<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('elections')
            ->withCount('elections')
            ->orderBy('elections_count', 'desc')
            ->orderBy('party', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('candidates.index', compact('candidates'));
    }

    public function show(int $id)
    {
        $candidate = Candidate::with('elections')->findOrFail($id);

        return view('candidates.show', compact('candidate'));
    }

    public function edit(int $id)
    {
        $candidate = Candidate::with('elections')->findOrFail($id);
        $elections = Election::all();

        return view('candidates.edit', compact('candidate', 'elections'));
    }

    public function update(Request $request, int $id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->update($request->only('name', 'party'));

        $candidate->elections()->sync($request->input('elections', []));

        return redirect()->route('candidates.show', $candidate->id);
    }

    public function create()
    {
        $elections = Election::all();

        return view('candidates.create', compact('elections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'party' => ['required', 'string', 'min:2', 'max:255'],
            'elections' => ['nullable', 'array'],
        ]);

        $candidate = Candidate::create([
            'name' => $request->name,
            'party' => $request->party,
        ]);

        $candidate->elections()->sync($request->elections);

        return redirect()->route('candidates.show', $candidate->id);
    }

    public function destroy(int $id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return redirect()->route('candidates.index');
    }
}
