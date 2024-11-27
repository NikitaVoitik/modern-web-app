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

    protected $fillable = [
        'election_date',
    ];
    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'election_candidates', 'election_id', 'candidate_id');
    }

    public function electionCandidates()
    {
        return $this->hasMany(ElectionCandidate::class);
    }

    public function votes()
    {
        return $this->hasManyThrough(
            Vote::class,
            ElectionCandidate::class,
        );
    }

    public function scopeLive($query)
    {
        return $query->whereDate('election_date', Carbon::today());
    }
}
