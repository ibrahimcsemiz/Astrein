<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RelationshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $employees = User::select('id', 'function')->where('function', 'Employee')->get();

        return [
            'user_id' => $this->faker->randomElement($employees),
        ];
    }
}
