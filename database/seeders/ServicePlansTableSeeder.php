<?php

namespace Database\Seeders;

use App\Models\ServicePlan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'sunday_wage' => Str::setPrice(rand(30, 60)),
        ]);

        ServicePlan::create([
            'name' => 'Suite',
            'hotel_id' => 1,
            'sunday_wage' => Str::setPrice(rand(30, 60)),
        ]);
    }
}
