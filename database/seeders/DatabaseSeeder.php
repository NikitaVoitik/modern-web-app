<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\ElectionCandidate;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users
        User::factory(100)->create();

        Election::factory(6)->create();

        Candidate::factory(9)->create();

        ElectionCandidate::factory(25)->uniqueCombination()->create();

        Vote::factory(100)->uniqueCombination()->create();
    }
}
