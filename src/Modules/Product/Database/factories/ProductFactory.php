<?php

namespace Modules\Product\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Product\Entities\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->sentence(1),
            'active' => true,
            'price' => fake()->numberBetween(1000, 3000),
            'tax' => fake()->numberBetween(1, 100),
            'discount' => fake()->numberBetween(1, 100),
            'inventory' => fake()->numberBetween(1, 100),
        ];
    }
}

