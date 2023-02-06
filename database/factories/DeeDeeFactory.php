<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeeDee>
 */
class DeeDeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'surname' => fake()->firstNameFemale . fake()->lastName(),
            'character_name' => fake()->firstNameFemale,
            'age' => fake()->numberBetween(18, 99),
            'character_type' => fake()->jobTitle(),
            'character_level' => fake()->bloodType(),
        ];
    }
}
