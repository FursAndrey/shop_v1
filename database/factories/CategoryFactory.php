<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
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
            'name' => 'Category'.$count,
            'code' => 'cat'.$count,
            'description' => $this->faker->realText(150, 1),
        ];
    }
}
