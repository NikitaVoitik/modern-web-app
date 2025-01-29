<?php

use App\Models\User;
use App\Models\ElectionCandidate;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('index returns votes', function () {
    Vote::factory()->count(3)->create();

    $response = $this->get('/api/votes');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('data')
        ->and($response->json()['data'])->toHaveLength(3);
});

test('store creates vote', function () {
    $user = User::factory()->create();
    $electionCandidate = ElectionCandidate::factory()->create();

    $response = $this->post('/api/votes', [
        'user_id' => $user->id,
        'election_candidate_id' => $electionCandidate->id,
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'data' => [
                'user_id' => $user->id,
                'election_candidate_id' => $electionCandidate->id,
            ]
        ]);

    $this->assertDatabaseHas('votes', [
        'user_id' => $user->id,
        'election_candidate_id' => $electionCandidate->id,
    ]);
});

test('show returns single vote', function () {
    $vote = Vote::factory()->create();

    $response = $this->get("/api/votes/{$vote->id}");

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $vote->id,
                'user_id' => $vote->user_id,
                'election_candidate_id' => $vote->election_candidate_id,
            ]
        ]);
});

test('update modifies vote', function () {
    $vote = Vote::factory()->create();
    $newElectionCandidate = ElectionCandidate::factory()->create();

    $response = $this->put("/api/votes/{$vote->id}", [
        'election_candidate_id' => $newElectionCandidate->id,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $vote->id,
                'election_candidate_id' => $newElectionCandidate->id,
            ]
        ]);

    $this->assertDatabaseHas('votes', [
        'id' => $vote->id,
        'election_candidate_id' => $newElectionCandidate->id,
    ]);
});

test('destroy deletes vote', function () {
    $vote = Vote::factory()->create();

    $response = $this->delete("/api/votes/{$vote->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('votes', [
        'id' => $vote->id,
    ]);
});
