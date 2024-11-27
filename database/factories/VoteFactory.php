<?php

namespace Database\Factories;

use App\Models\Election;
use App\Models\ElectionCandidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vote>
 */
class VoteFactory extends Factory
{
    protected static array $usedCombinations = [];
    private static int $user_id = 1;
    private static int $election_id = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'election_candidate_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 1000),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }

    public function uniqueCombination(): VoteFactory|Factory
    {
        return $this->state(function (array $attributes) {
            $results = [];
            for (;self::$user_id <= 95; self::$user_id++){
                for (;self::$election_id <= 5;){
                    do {
                        $election_candidate_id = ElectionCandidate::where('election_id', self::$election_id)->pluck('id')->toArray();
                        $election_candidate_id = $election_candidate_id[array_rand($election_candidate_id)];
                        $comb = $election_candidate_id . '-' . self::$user_id;
                        $check = in_array($comb, self::$usedCombinations);
                    } while($check);
                    self::$usedCombinations[] = $comb;
                    self::$election_id++;
                    return [
                        'election_candidate_id' => $election_candidate_id,
                        'user_id' => self::$user_id,
                    ];
                }
                self::$election_id = 1;
            }
            return [
                'election_candidate_id' => $this->faker->numberBetween(1, 10),
                'user_id' => $this->faker->numberBetween(1, 1000),
            ];
        });
    }
}
