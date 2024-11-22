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


        Election::factory(6)->create();


        Candidate::factory(8)->create();

        ElectionCandidate::factory(15)->uniqueCombination()->create();

        Vote::factory(40)->uniqueCombination()->create();

    }
}
