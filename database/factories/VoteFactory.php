<?php

namespace Database\Factories;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vote>
 */
class VoteFactory extends Factory
{
    protected static array $usedCombinations = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'election_candidate_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 20),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }

    public function uniqueCombination(): VoteFactory|Factory
    {
        return $this->state(function (array $attributes) {
            do {
                $election_candidate_id = $this->faker->numberBetween(1, 10);
                $user_id = $this->faker->numberBetween(1, 20);
                $combination = $election_candidate_id . '-' . $user_id;
            } while (in_array($combination, self::$usedCombinations));

            self::$usedCombinations[] = $combination;

            return [
                'election_candidate_id' => $election_candidate_id,
                'user_id' => $user_id,
            ];
        });
    }
}
