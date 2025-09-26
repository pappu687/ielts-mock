<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\QuestionBank;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_bank_id' => QuestionBank::factory(),
            'question_text' => $this->faker->sentence,
            'question_type' => $this->faker->randomElement(['multiple_choice', 'fill_in_the_blank', 'short_answer', 'essay']),
            'content' => [
                'text' => $this->faker->sentence,
            ],
            'difficulty_level' => $this->faker->randomElement(['easy', 'medium', 'hard']),            
            'estimated_time' => $this->faker->numberBetween(1, 10),
            'metadata' => [
                'source' => $this->faker->randomElement(['generated', 'manual']),
                'tags' => $this->faker->words(3),
            ],
            'audio_file' => $this->faker->url,
            'image_files' => [$this->faker->imageUrl()],
            'correct_answers' => [$this->faker->word()],
            'explanation' => $this->faker->sentence,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
            'tips' => $this->faker->sentence,
            'skill_focus_areas' => $this->faker->words(2),
        ];
    }
}
