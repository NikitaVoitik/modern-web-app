<?php

use App\Models\Candidate;
use App\Models\Election;
use App\Models\ElectionCandidate;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('user creation', function () {
    $user = User::factory()->create();
    expect($user->id)->toBeGreaterThan(0);
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});

test('election creation', function () {
    $election = Election::factory()->create();
    expect($election->id)->toBeGreaterThan(0);
    $this->assertDatabaseHas('elections', ['id' => $election->id]);
});

test('candidate creation', function () {
    $candidate = Candidate::factory()->create();
    expect($candidate->id)->toBeGreaterThan(0);
    $this->assertDatabaseHas('candidates', ['id' => $candidate->id]);
});

test('election candidate creation', function () {
    $electionCandidate = ElectionCandidate::factory()->create();
    expect($electionCandidate->id)->toBeGreaterThan(0);
    $this->assertDatabaseHas('election_candidates', ['id' => $electionCandidate->id]);
});

test('vote creation', function () {
    $vote = Vote::factory()->create();
    expect($vote->id)->toBeGreaterThan(0);
    $this->assertDatabaseHas('votes', ['id' => $vote->id]);
});
