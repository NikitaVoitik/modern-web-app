<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\ElectionCandidate;
use App\Models\User;
use Illuminate\Http\Request;

class VoteController extends Controller
{
public function index()
{
    $elections = Election::live()->with('candidates')->get();

    $elections = $elections->filter(function ($election) {
        return !auth()->user()->votedInElection($election->id);
    });

    $candidateToElectionCandidateMap = ElectionCandidate::whereIn('election_id', $elections->pluck('id'))
        ->get()
        ->mapWithKeys(function ($electionCandidate) {
            return [$electionCandidate->candidate_id => $electionCandidate->id];
        });

    return view('vote.index', compact('elections', 'candidateToElectionCandidateMap'));
}

    public function store()
    {
        request()->validate([
            'candidate_checkbox' => ['required', 'exists:election_candidates,id'],
            'election_id' => ['required', 'exists:elections,id'],
        ]);
        if (auth()->user()->votedInElection(request('election_id'))){
            return redirect()->route('vote.index')->withErrors(['error' => 'You have already voted in this election']);
        }

        auth()->user()->votes()->create([
            'election_candidate_id' => request('candidate_checkbox'),
        ]);

        return redirect()->route('vote.index');
    }

}
