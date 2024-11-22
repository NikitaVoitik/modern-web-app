<?php

namespace App\Models;

use Database\Factories\CandidateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    /** @use HasFactory<CandidateFactory> */
    use HasFactory;

    public function elections()
    {
        return $this->belongsToMany(Election::class, 'election_candidates', 'candidate_id', 'election_id');
    }
}
