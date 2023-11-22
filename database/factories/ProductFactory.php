<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randprice = [];
        $start = 5000;
        for ($i = 0; $i < 10; $i++) {
            $start += $start + 5000;
            array_push($randprice, $start);
        }
        return [
            'code'          => fake()->unique()->countryCode(),
            'name'          => fake()->userName(),
            'sell_price'    => fake()->randomElement($randprice),
            'purc_price'    => fake()->numberBetween($randprice),
        ];
    }
}
