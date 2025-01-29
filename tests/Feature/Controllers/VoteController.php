<?php

use App\Models\User;
use App\Models\Vote;
use App\Models\ElectionCandidate;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('index returns votes', function () {
    Vote::factory()->count(3)->create(['user_id' => $this->user->id]);

    $response = $this->actingAs($this->user)->get('/votes');

    $response->assertStatus(200);
    expect($response->viewData('votes'))->toHaveCount(3);
});

test('show returns single vote', function () {
    $vote = Vote::factory()->create(['user_id' => $this->user->id]);

    $response = $this->actingAs($this->user)->get("/votes/{$vote->id}");

    $response->assertStatus(200);
    expect($response->viewData('vote')->id)->toBe($vote->id);
});

test('create returns view', function () {
    $response = $this->actingAs($this->user)->get('/votes/create');

    $response->assertStatus(200);
});

test('store creates vote', function () {
    $electionCandidate = ElectionCandidate::factory()->create();
    $voteData = [
        'election_candidate_id' => $electionCandidate->id,
    ];

    $response = $this->actingAs($this->user)->post('/votes', $voteData);

    $response->assertRedirect();
    $this->assertDatabaseHas('votes', [
        'user_id' => $this->user->id,
        'election_candidate_id' => $electionCandidate->id,
    ]);
});

test('edit returns vote', function () {
    $vote = Vote::factory()->create(['user_id' => $this->user->id]);

    $response = $this->actingAs($this->user)->get("/votes/{$vote->id}/edit");

    $response->assertStatus(200);
    expect($response->viewData('vote')->id)->toBe($vote->id);
});

test('update modifies vote', function () {
    $vote = Vote::factory()->create(['user_id' => $this->user->id]);
    $newData = [
        'election_candidate_id' => ElectionCandidate::factory()->create()->id,
    ];

    $response = $this->actingAs($this->user)->put("/votes/{$vote->id}", $newData);

    $response->assertRedirect("/votes/{$vote->id}");
    $this->assertDatabaseHas('votes', [
        'id' => $vote->id,
        'election_candidate_id' => $newData['election_candidate_id'],
    ]);
});

test('destroy deletes vote', function () {
    $vote = Vote::factory()->create(['user_id' => $this->user->id]);

    $response = $this->actingAs($this->user)->delete("/votes/{$vote->id}");

    $response->assertRedirect('/votes');
    $this->assertDatabaseMissing('votes', [
        'id' => $vote->id,
    ]);
});
