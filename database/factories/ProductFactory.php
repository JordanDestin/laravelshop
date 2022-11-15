<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

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
    public function definition()
    {

        $categoryIDs = Category::pluck('id');
        return [
            'name' => $this->faker->sentence(rand(1,3),true),
            'description'=> $this->faker->sentence(),
            'image'=> $this->faker->imageUrl(),
            'price'=> rand(1000, 15000),
            'active'=> $this->faker->boolean(80),
            'tendance'=> $this->faker->boolean(80),
            'category_id'=> $categoryIDs->random()

        ];
    }
}
