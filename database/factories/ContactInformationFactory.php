<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'telephone' => $this->faker->unique()->phoneNumber(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
        ];
    }
}
