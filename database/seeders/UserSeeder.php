<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => 'Ilham Maulana',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('k5Upukr1Ng4n'), // password
            'phone' => "628954830",
            'photo' => 'https://placehold.co/600x400?text=User+Photo'
        ]);

        User::create([
            "name" => 'Adrial G',
            'email' => 'adrialg@gmail.com',
            'password' => bcrypt('jawAh2so'), // password
            'phone' => "628189280",
            'photo' => null
        ]);
        User::create([
            "name" => 'Danendra N',
            'email' => 'danendaranr@gmail.com',
            'password' => bcrypt('pr20sow0G'), // password
            'phone' => "6281891309280",
            'photo' => null
        ]);
        User::factory(10)->create();
    }
}
