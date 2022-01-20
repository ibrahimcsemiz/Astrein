<?php

namespace Database\Seeders;

use App\Models\ServicePlan;
use Illuminate\Database\Seeder;

class ServicePlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServicePlan::create([
            'name' => 'Zimmer',
            'hotel_id' => 1,
            'sunday_wage' => rand(10, 30),
        ]);

        ServicePlan::create([
            'name' => 'Suite',
            'hotel_id' => 1,
            'sunday_wage' => rand(30, 60),
        ]);
    }
}
