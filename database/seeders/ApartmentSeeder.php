<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        /* RECUPERO ARRAY ASSOCIATIVO IN CONFIG */
        $apartments = config('apartments');
        

        /* CICLO SUL L'ARRAY CREANDO UNA NUOVA ISTANZA E DANDOGLI DEI VALORI AD OGNI SINGOLO ELEMENTO */
        foreach ($apartments as $apartment) {
            $new_apartment = new Apartment();
            $new_apartment->title = $apartment['title'];
            $new_apartment->user_id = $apartment['user_id'];
            $new_apartment->description = $apartment['description'];
            $new_apartment->cover = $apartment['cover'];
            $new_apartment->is_visible = $apartment['is_visible'];
            $new_apartment->rooms = $apartment['rooms'];
            $new_apartment->beds = $apartment['beds'];
            $new_apartment->bathrooms = $apartment['bathrooms'];
            $new_apartment->sqm = $apartment['sqm'];
            $new_apartment->address = $apartment['address'];
            $new_apartment->latitude = $apartment['latitude'];
            $new_apartment->longitude = $apartment['longitude'];

            $new_apartment->save();
        }
    }
}