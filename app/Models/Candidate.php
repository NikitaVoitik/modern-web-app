<?php

namespace App\Models;

use Database\Factories\CandidateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    /** @use HasFactory<CandidateFactory> */
    use HasFactory;

    protected $fillable = ['name', 'party'];

    public function elections()
    {
        return $this->belongsToMany(Election::class, 'election_candidates', 'candidate_id', 'election_id');
    }

    public function getVotesElection($election_id)
    {
        $election_candidate_id = ElectionCandidate::where('candidate_id', $this->id)
            ->where('election_id', $election_id)->get('id');
        return Vote::where('election_candidate_id', $election_candidate_id->id)->count();
    }

    public function getVotesAllElections()
    {
        $electionCandidates = ElectionCandidate::where('candidate_id', $this->id)->get();
        $votesMap = [];

        foreach ($electionCandidates as $electionCandidate) {
            $votesCount = Vote::where('election_candidate_id', $electionCandidate->id)->count();
            $votesMap[$electionCandidate->election_id] = $votesCount;
        }
        return $votesMap;
    }
}
