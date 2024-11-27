<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'date_of_birth',
        'passport_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class, 'user_id');
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function hasVotedInElection($election_id)
    {
        $election_candidate_ids = ElectionCandidate::where('election_id', $election_id)->pluck('id');
        return Vote::whereIn('election_candidate_id', $election_candidate_ids)
            ->where('user_id', $this->id)
            ->exists();
    }

    public function getVotedElections()
    {
        return $this->votes()
            ->with('electionCandidate.election')
            ->get()
            ->pluck('electionCandidate.election')
            ->sortByDesc('election_date')
            ->values();
    }

    public function getVotedCandidateForElection($election_id)
    {
        $election_candidate = ElectionCandidate::where('election_id', $election_id)->pluck('id');
        $candidate = $this->votes()->whereIn('election_candidate_id', $election_candidate->pluck('id'))->with(['electionCandidate' => function ($query) {
            $query->with('candidate');
        }])->get()->whereNotNull('electionCandidate.election')->pluck('electionCandidate.candidate');
        if ($candidate->isEmpty()) {
            return null;
        }
        return $candidate->first();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
