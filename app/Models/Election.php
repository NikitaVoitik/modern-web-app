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

    public function electionCandidate()
    {
        return $this->hasMany(ElectionCandidate::class);
    }

    public function votes()
    {
        return $this->hasManyThrough(
            Vote::class,
            ElectionCandidate::class,
            'election_id', // Foreign key on the ElectionCandidate table
            'election_candidate_id', // Foreign key on the Vote table
            'id', // Local key on the Election table
            'id'  // Local key on the ElectionCandidate table
        );
    }

    public function scopeLive(Builder $query)
    {
        return $query->where('election_date', '=', Carbon::now()->toDateString());
    }
}
