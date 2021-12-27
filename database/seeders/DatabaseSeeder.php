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
        /*for ($i = 0; $i < 155; $i++) {
            $user = User::factory()->create();

            $contact = ContactInformation::factory()
                ->count(1)
                ->for($user)
                ->create();

            $personal = PersonalInformation::factory()
                ->count(1)
                ->for($user)
                ->create();
        }*/

        /*for ($i = 0; $i < 58; $i++) {
            $hotel = Hotel::factory()->create();
        }*/
    }
}
