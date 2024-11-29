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
        User::factory(300)->create();

        Election::factory(6)->create();

        Candidate::factory(9)->create();

        ElectionCandidate::factory(25)->uniqueCombination()->create();

        Vote::factory(1200)->uniqueCombination()->create();

        User::create(['first_name' => 'Admin', 'last_name' => 'Admin', 'email' => 'admin@example.com', 'passport_number' => 'admin', 'date_of_birth' => '2000-09-15', 'password' => Hash::make('admin'), 'is_admin' => 1]);
        User::create(['first_name' => 'Igor', 'last_name' => 'Moroz', 'email' => 'example@example.com', 'passport_number' => 'igormoroz', 'date_of_birth' => '2000-09-15', 'password' => Hash::make('password'), 'is_admin' => 0]);

    }
}
