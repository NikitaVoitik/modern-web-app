<?php

use App\Models\User;
use App\Models\Election;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
});

test('index returns elections', function () {
    Election::factory()->count(3)->create();

    $response = $this->actingAs($this->admin)->get('/elections');

    $response->assertStatus(200);
    expect($response->viewData('elections'))->toHaveCount(3);
});

test('show returns single election', function () {
    $election = Election::factory()->create();

    $response = $this->actingAs($this->admin)->get("/elections/{$election->id}");

    $response->assertStatus(200);
    expect($response->viewData('election')->id)->toBe($election->id);
});

test('create returns view', function () {
    $response = $this->actingAs($this->admin)->get('/elections/create');

    $response->assertStatus(200);
});

test('store creates election', function () {
    $electionData = [
        'election_date' => '2024-11-05',
    ];

    $response = $this->actingAs($this->admin)->post('/elections', $electionData);

    $response->assertRedirect();
    $this->assertDatabaseHas('elections', [
        'election_date' => '2024-11-05',
    ]);
});

test('edit returns election', function () {
    $election = Election::factory()->create();

    $response = $this->actingAs($this->admin)->get("/elections/{$election->id}/edit");

    $response->assertStatus(200);
    expect($response->viewData('election')->id)->toBe($election->id);
});

test('update modifies election', function () {
    $election = Election::factory()->create();
    $newData = [
        'election_date' => '2025-11-05',
    ];

    $response = $this->actingAs($this->admin)->put("/elections/{$election->id}", $newData);

    $response->assertRedirect("/elections/{$election->id}");
    $this->assertDatabaseHas('elections', [
        'id' => $election->id,
        'election_date' => '2025-11-05',
    ]);
});

test('destroy deletes election', function () {
    $election = Election::factory()->create();

    $response = $this->actingAs($this->admin)->delete("/elections/{$election->id}");

    $response->assertRedirect('/elections');
    $this->assertDatabaseMissing('elections', [
        'id' => $election->id,
    ]);
});
