<?php

namespace Database\Factories;

use Carbon\Traits\ToStringFormat;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories= ['Phones','Laptops','Clothes','Toys'];
        return [
        
            "name"=> $this->faker->unique()->randomElement($categories), 
            'is_active'=> $this->faker->numberBetween(0, 1)
        ];
    }
}