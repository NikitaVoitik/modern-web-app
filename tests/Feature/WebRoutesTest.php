<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

test('elections index route', function () {
    $response = $this->get('/elections');
    $response->assertStatus(200);
});

test('candidates index route', function () {
    $response = $this->get('/candidates');
    $response->assertStatus(200);
});

test('vote index route', function () {
    $response = $this->get('/vote');
    $response->assertStatus(302);
});

test('profile edit route', function () {
    $response = $this->get('/profile');
    $response->assertStatus(302);
});

test('trends index route', function () {
    $response = $this->get('/trends');
    $response->assertStatus(200);
});

test('election candidates api index route', function () {
    $response = $this->get('/api/election-candidates');
    $response->assertStatus(200);
});

test('votes api index route', function () {
    $response = $this->get('/api/votes');
    $response->assertStatus(200);
});
