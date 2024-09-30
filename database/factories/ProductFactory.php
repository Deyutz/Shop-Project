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
        return [
            "name"=>"Product".$this->faker->unique()->numberBetween(1,20),
            "price"=>$this->faker->randomFloat(2,0,100),
            "description"=>fake()->sentence(rand(1,15)),
            "stock"=>$this->faker->numberBetween(1,100),
            "category_id"=>$this->faker->numberBetween(1,3)
        ];
    }
}
