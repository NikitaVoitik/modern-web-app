<?php

namespace App\Models;

use Database\Factories\ElectionCandidateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionCandidate extends Model
{
    /** @use HasFactory<ElectionCandidateFactory> */
    use HasFactory;

    protected $fillable = ['election_id', 'candidate_id'];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
