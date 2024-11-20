<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ElectionCandidate>
 */
class ElectionCandidateFactory extends Factory
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
            'election_id' => $this->faker->numberBetween(1, 3),
            'candidate_id' => $this->faker->numberBetween(2, 6),
        ];
    }

    public function uniqueCombination(): ElectionCandidateFactory|Factory
    {
        return $this->state(function (array $attributes) {
            do {
                $election_id = $this->faker->numberBetween(1, 3);
                $candidate_id = $this->faker->numberBetween(2, 6);
                $combination = $election_id . '-' . $candidate_id;
            } while (in_array($combination, self::$usedCombinations));

            self::$usedCombinations[] = $combination;

            return [
                'election_id' => $election_id,
                'candidate_id' => $candidate_id,
            ];
        });
    }
}
