<?php

namespace Database\Seeders;

use App\Models\CategoryDestination;
use Illuminate\Database\Seeder;

class CategoryDestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                "name" => "Tour"
            ],
            [
                "name" => "Nature"
            ],
            [
                "name" => "Aesthetic"
            ]
        ])->each(function ($data) {
            CategoryDestination::create($data);
        });
    }
}
