<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'productName' => $this->faker->numerify('Product - ####'),
            'productCategory' => $this->faker->randomElement(['Beverage', 'Food']),
            'productPrice' => $this->faker->numberBetween(10000, 30000),
            'productStock' => $this->faker->numberBetween(0,30)
        ];
    }
}
