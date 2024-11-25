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
        $electionCandidateIds = ElectionCandidate::where('candidate_id', $this->id)->pluck('id');
        $votes = Vote::whereIn('election_candidate_id', $electionCandidateIds)
            ->select('election_candidate_id', \DB::raw('count(*) as votes_count'))
            ->groupBy('election_candidate_id')
            ->get()
            ->pluck('votes_count', 'election_candidate_id');

        $votesMap = [];
        foreach ($electionCandidateIds as $electionCandidateId) {
            $votesMap[$electionCandidateId] = $votes->get($electionCandidateId, 0);
        }

        return $votesMap;
    }
}
