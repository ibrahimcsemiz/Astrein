<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Storage::disk('local')->get('json/germany.json');
        $json = json_decode($file);

        foreach ($json as $key => $value) {
            Region::firstOrCreate([
                'name' => $value
            ]);
        }
    }
}
