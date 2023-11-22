<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adjustment>
 */
class AdjustmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date'          => fake()->dateTimeThisYear(),
            'number'        => fake()->randomDigitNotZero(),
            'current_value' => fake()->randomDigitNotZero(),
            'type'          => fake()->randomElement(['plus', 'minus']),
            'value'         => fake()->randomDigitNotZero(),
            'after_value'   => fake()->randomDigitNotZero(),
            'status'        => fake()->randomElement(['done', 'cancel']),
            'desc'          => fake()->text(50),
        ];
    }
}
