<?php

namespace App\Models;

use Database\Factories\VoteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /** @use HasFactory<VoteFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'election_candidate_id',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function electionCandidate()
    {
        return $this->belongsTo(ElectionCandidate::class, 'election_candidate_id');
    }

    public function candidate()
    {
        return $this->hasOneThrough(
            Candidate::class,
            ElectionCandidate::class,
        );
    }

    public function election()
    {
        return $this->hasOneThrough(
            Election::class,
            ElectionCandidate::class,
        );
    }
}
