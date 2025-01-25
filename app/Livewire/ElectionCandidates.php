<?php

namespace App\Livewire;

use App\Models\Election;
use Livewire\Component;

class ElectionCandidates extends Component
{
    public $election;
    public $votedFor;

    public function mount($election, $votedFor = null)
    {
        $this->election = $election;
        $this->votedFor = $votedFor;
    }

    public function render()
    {
        $id = $this->election->id;
        $election = Election::with(['candidates.electionCandidate' => function ($query) use ($id) {
            $query->where('election_id', $id)->withCount('votes');
        }])->withCount('votes')->findOrFail($id);
        $votesMap = [];
        foreach ($election->candidates as $candidate) {
            $votesMap[$candidate->id] = $candidate->electionCandidate->first()->votes_count;
        }

        return view('livewire.election-candidates', [
            'votesMap' => $votesMap
        ])->with('poll', true);
    }
}
