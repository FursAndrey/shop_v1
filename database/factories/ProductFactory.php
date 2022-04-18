<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $count = mt_rand(1, 20);
        return [
            'short_name' => 'shortN'.$count,
            'full_name' => $this->faker->name(),
            'description' => $this->faker->realText(150, 1),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
