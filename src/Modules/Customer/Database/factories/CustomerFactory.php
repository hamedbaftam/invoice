<?php

namespace Modules\Customer\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Customer\Entities\Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstName = fake()->name();
        $lastName = fake()->lastName();
        return [
            'demonstration_name' => $firstName.$lastName,
            'active' => true,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'social_id' => '123456778', // password
            'birthday' => fake()->dateTime(),
            'mobile_number' => "09189329597",
            'mobile_number_description' => fake()->text(10),
            'email' => fake()->unique()->safeEmail(),
            'email_description' => fake()->text(10),
        ];
    }
}

