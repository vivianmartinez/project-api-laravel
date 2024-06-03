<?php

namespace Database\Factories;

use App\Models\Category;
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
        return [
            //
            'category_id' => Category::all()->random()->id,
            'name'        => $this->faker->word(10),
            'description' => $this->faker->realText(255),
            'price'       => $this->faker->randomFloat(2,1,15),
        ];
    }
}
