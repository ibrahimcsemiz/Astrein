<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Database\Seeder;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 50; $i++) {

            $manager = User::where('function', 'Manager')->inRandomOrder()->first()->id;
            $foreman = User::where('function', 'Foreman')->inRandomOrder()->first()->id;

            Hotel::create([
                'name' => 'Test Hotel ' . $i,
                'email' => 'test-hotel-' . $i . '@example.com',
                'telephone' => rand(1929568252, 9827561385),
                'region_id' => rand(1, 16),
                'foreman_id' => $foreman,
                'manager_id' => $manager,
            ]);
        }
    }
}
