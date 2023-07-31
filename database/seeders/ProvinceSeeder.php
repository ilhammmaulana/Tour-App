<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('resources/province.json'));
        $provinces = json_decode($json, true);

        foreach ($provinces as $province) {
            Province::create([
                'name' => $province['name'],
            ]);
        }
    }
}
