<?php

use App\Models\Candidate;
use App\Models\Election;
use App\Models\ElectionCandidate;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('index returns election candidates', function () {
    Election::factory()->count(10)->create();
    Candidate::factory()->count(10)->create();
    ElectionCandidate::factory(3)->uniqueCombination()->create();

    $response = $this->get('/api/election-candidates/');

    $response->assertStatus(200);
    expect($response->json())->toHaveKey('data')
        ->and($response->json()['data'])->toHaveLength(3);
});

test('show returns single election candidate', function () {
    Election::factory()->count(10)->create();
    Candidate::factory()->count(10)->create();
    $electionCandidate = ElectionCandidate::factory(1)->uniqueCombination()->create()[0];

    $response = $this->get("/api/election-candidates/{$electionCandidate->id}");

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $electionCandidate->id,
                'election' => $electionCandidate->election_id,
                'candidate' => $electionCandidate->candidate_name,
            ]
        ]);
});
