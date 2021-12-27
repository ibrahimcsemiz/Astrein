<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $managers = User::select('id', 'function')->where('function', 'Manager')->get();
        $foremans = User::select('id', 'function')->where('function', 'Foreman')->get();

        $region = Region::select('id')->get();

        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'region' => $this->faker->randomElement($region),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'foreman' => $this->faker->randomElement($foremans),
            'manager' => $this->faker->randomElement($managers),
        ];
    }
}
