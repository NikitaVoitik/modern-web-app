<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\ElectionCandidate;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users
        User::factory(20)->create();


        $elections = Election::factory(3)->create();


        $candidates = Candidate::factory(8)->create();

        $election_candidates = ElectionCandidate::factory(10)->uniqueCombination()->create();

        $votes = Vote::factory(20)->create();
    }
}
