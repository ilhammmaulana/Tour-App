<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('resources/city.json'));
        $cities = json_decode($json, true);

        foreach ($cities as $city) {
            City::create([
                'name' => $city['name'],
            ]);
        }
    }
}
