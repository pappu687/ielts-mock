<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionBanks>
 */
class QuestionBankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'difficulty_level' => $this->faker->randomElement(['easy', 'medium', 'hard']),
            'skill_type' => $this->faker->randomElement(['listening', 'reading', 'writing', 'speaking']),
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean,
            'created_by' => User::factory(),
        ];
    }
}
