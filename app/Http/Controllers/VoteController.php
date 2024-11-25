<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\ElectionCandidate;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        $elections = Election::live()->with('candidates')->get();
        $electionCandidates = ElectionCandidate::whereIn('election_id', $elections->pluck('id'))
            ->get();

        $candidateToElectionCandidateMap = $electionCandidates->mapWithKeys(function ($electionCandidate) {
            return [$electionCandidate->candidate_id => $electionCandidate->id];
        });

        return view('vote.index', compact('elections', 'candidateToElectionCandidateMap'));
    }

    public function store()
    {
        //dd(request()->all());
        request()->validate([
            'candidate_checkbox' => ['required', 'exists:election_candidates,id'],
        ]);


        auth()->user()->votes()->create([
            'election_candidate_id' => request('candidate_checkbox'),
        ]);

        return redirect()->route('vote.index');
    }

}
