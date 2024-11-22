<?php

namespace Database\Factories;

use App\Models\ElectionCandidate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ElectionCandidate>
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
            'election_id' => $this->faker->numberBetween(1, 5),
            'candidate_id' => $this->faker->numberBetween(1, 6),
        ];
    }

    public function uniqueCombination(): ElectionCandidateFactory|Factory
    {
        return $this->state(function (array $attributes) {
            do {
                $election_id = $this->faker->numberBetween(1, 5);
                $candidate_id = $this->faker->numberBetween(1, 6);
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
