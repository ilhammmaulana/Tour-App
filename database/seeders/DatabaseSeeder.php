<?php

namespace Database\Seeders;

use App\Models\CategoryDestination;
use App\Models\Destination;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategoryDestinationSeeder::class,
            DestinationSeeder::class,
        ]);
    }
}
