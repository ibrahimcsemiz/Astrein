<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 60; $i++) {
            if ($i < 3) {
                $function = 'Admin';
            } elseif ($i > 2 && $i < 7) {
                $function = 'Office';
            } elseif ($i > 6 && $i < 14) {
                $function = 'Manager';
            } elseif ($i > 13 && $i < 25) {
                $function = 'Foreman';
            } else {
                $function = 'Employee';
            }

            $insertUser = User::create([
                'name' => $function . ' ' . $i,
                'email' => Str::lower($function) . '-' . $i . '@localhost.com',
                'function' => $function,
                'status' => 1,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $insertUser?->contact()->create([
                'telephone' => rand(1929568252, 9827561385),
            ]);
        }
    }
}
