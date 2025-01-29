<?php

use App\Models\User;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
});

test('index returns candidates', function () {
    Candidate::factory()->count(3)->create();

    $response = $this->actingAs($this->admin)->get('/candidates');

    $response->assertStatus(200);
    expect($response->viewData('candidates'))->toHaveCount(3);
});

test('show returns single candidate', function () {
    $candidate = Candidate::factory()->create();

    $response = $this->actingAs($this->admin)->get("/candidates/{$candidate->id}");

    $response->assertStatus(200);
    expect($response->viewData('candidate')->id)->toBe($candidate->id);
});

test('edit returns candidate and elections', function () {
    $candidate = Candidate::factory()->create();
    Election::factory()->count(3)->create();

    $response = $this->actingAs($this->admin)->get("/candidates/{$candidate->id}/edit");

    $response->assertStatus(200);
    expect($response->viewData('candidate')->id)->toBe($candidate->id);
    expect($response->viewData('elections'))->toHaveCount(3);
});

test('update modifies candidate', function () {
    $candidate = Candidate::factory()->create();
    $newData = [
        'name' => 'Updated Name',
        'party' => 'Updated Party',
        'elections' => Election::factory()->count(2)->create()->pluck('id')->toArray(),
    ];

    $response = $this->actingAs($this->admin)->put("/candidates/{$candidate->id}", $newData);

    $response->assertRedirect("/candidates/{$candidate->id}");
    $this->assertDatabaseHas('candidates', [
        'id' => $candidate->id,
        'name' => 'Updated Name',
        'party' => 'Updated Party',
    ]);
    $this->assertDatabaseCount('election_candidates', 2);
});

test('store creates candidate', function () {
    $elections = Election::factory()->count(2)->create();
    $candidateData = [
        'name' => 'New Candidate',
        'party' => 'New Party',
        'elections' => $elections->pluck('id')->toArray(),
    ];

    $response = $this->actingAs($this->admin)->post('/candidates', $candidateData);

    $response->assertRedirect();
    $this->assertDatabaseHas('candidates', [
        'name' => 'New Candidate',
        'party' => 'New Party',
    ]);
    $this->assertDatabaseCount('election_candidates', 2);
});

test('create returns elections', function () {
    Election::factory()->count(3)->create();

    $response = $this->actingAs($this->admin)->get('/candidates/create');

    $response->assertStatus(200);
    expect($response->viewData('elections'))->toHaveCount(3);
});

test('destroy deletes candidate', function () {
    $candidate = Candidate::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/candidates/{$candidate->id}");

    $response->assertRedirect('/candidates');
    $this->assertDatabaseMissing('candidates', [
        'id' => $candidate->id,
    ]);
});
