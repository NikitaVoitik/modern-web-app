<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\ElectionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    /** @use HasFactory<ElectionFactory> */
    use HasFactory;

    protected $fillable =[
        'election_date',
    ];
    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'election_candidates', 'election_id', 'candidate_id');
    }

    public function getVotesCandidate($candidate_id)
    {
        $election_candidate_id = ElectionCandidate::where('election_id', $this->id)
            ->where('candidate_id', $candidate_id)->get('id');
        return Vote::where('election_candidate_id', $election_candidate_id->id)->count();
    }

    public function getVotesAllCandidates()
    {
        $electionCandidates = ElectionCandidate::where('election_id', $this->id)->get();
        $votesMap = [];

        foreach ($electionCandidates as $electionCandidate) {
            $votesCount = Vote::where('election_candidate_id', $electionCandidate->id)->count();
            $votesMap[$electionCandidate->candidate_id] = $votesCount;
        }
        return $votesMap;
    }

    public function scopeLive(Builder $query)
    {
        return $query->where('election_date', '=', Carbon::now()->toDateString());
    }
}
