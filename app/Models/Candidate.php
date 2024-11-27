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

    public function votes()
    {
        return $this->hasManyThrough(
            Vote::class,
            ElectionCandidate::class
        );
    }

    public function electionCandidate()
    {
        return $this->hasMany(ElectionCandidate::class);
    }
}
