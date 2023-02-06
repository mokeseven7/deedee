<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Renter>
 */
class RenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = fake()->unique()->company();

        return [
            'name' => $company,
            'domain' => fake()->word . '.' . fake()->unique()->domainName(),
            'database' => $company . '_database',
        ];
    }

    public function realDomain(){
        
        return $this->state(function (array $attributes) {
            
            return [
                'name' => $attributes['name'],
                'domain' => 'https://mokeseven7-scaling-engine-9749r55qxgjh794v-8000.preview.app.github.dev',
                'database' => $attributes['name'] . '_database',
            ];
        });
    }

    public function localhost(){
        
        return $this->state(function (array $attributes) {
            
            return [
                'name' => $attributes['name'],
                'domain' => 'localhost',
                'database' => $attributes['name'] . '_database',
            ];
        });
    }
}
