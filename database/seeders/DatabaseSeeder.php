<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        /* USER PRINCIPALE */
        \App\Models\User::factory()->create([
            'name' => 'boolbnb',
            'email' => 'bool@gmail.com',

        ]);


        /* RECUPERI VALORI FATTI NEL SEEDER */
        $this->call([ApartmentSeeder::class, ServiceSeeder::class, PhotoSeeder::class]);


        /* VALORI FAKE */
        \App\Models\View::factory(10)->create();
        \App\Models\Message::factory(15)->create();
    }
}
