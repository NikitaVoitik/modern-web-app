<?php

namespace App\Models;

use Database\Factories\ElectionCandidateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionCandidate extends Model
{
    /** @use HasFactory<ElectionCandidateFactory> */
    use HasFactory;

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id');
    }
}
