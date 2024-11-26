<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

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
        return $this->hasMany(Vote::class);
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function votedInElection($election_id)
    {
        $election_candidate_ids = ElectionCandidate::where('election_id', $election_id)->pluck('id');
        return Vote::whereIn('election_candidate_id', $election_candidate_ids)
            ->where('user_id', $this->id)
            ->exists();
    }

    public function findVotedInElections()
    {
        $election_candidate_ids = Vote::where('user_id', $this->id)->pluck('election_candidate_id');
        $elections_ids = ElectionCandidate::whereIn('id', $election_candidate_ids)->pluck('election_id');
        return Election::whereIn('id', $elections_ids);
    }

    public function findVotedFor($election_id)
    {
        $election_candidate_ids = ElectionCandidate::where('election_id', $election_id)->pluck('id');
        $vote = Vote::whereIn('election_candidate_id', $election_candidate_ids)
            ->where('user_id', $this->id)
            ->first();
        //dd($vote);
        if ($vote) {
            $candidate_id = ElectionCandidate::where('id', $vote->election_candidate_id)
                ->value('candidate_id');
            #dd($this->id, $vote, $candidate_id, Candidate::find($candidate_id));
            return Candidate::find($candidate_id);
        }

        return null;
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
