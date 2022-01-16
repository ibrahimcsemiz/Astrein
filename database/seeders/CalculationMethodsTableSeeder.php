<?php

namespace Database\Seeders;

use App\Models\CalculationMethod;
use Illuminate\Database\Seeder;

class CalculationMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $minute = [15, 30, 60];

        for ($i = 1; $i < 10; $i++) {
            $insertCalculationMethod = CalculationMethod::create([
                'name' => 'Test Method ' . $i,
                'calculation_per_minute' => $minute[array_rand($minute)],
                'editable' => 1
            ]);
        }
    }
}
