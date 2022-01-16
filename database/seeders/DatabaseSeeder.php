<?php

namespace Database\Seeders;

use App\Models\ContactInformation;
use App\Models\Hotel;
use App\Models\PersonalInformation;
use App\Models\HotelUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RegionTableSeeder::class,
            HotelsTableSeeder::class,
            CalculationMethodsTableSeeder::class,
        ]);
    }
}
