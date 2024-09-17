<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /* CREO UN ARRAY CON DENTRO GLI ID DEGLI APPARTMENTI */
        $apartments_ids = Apartment::pluck('id')->toArray();

        /* RECUPERO ARRAY ASSOCIATIVO IN CONFIG */
        $services = config('apartment_services');


        /* CICLO SUL L'ARRAY CREANDO UNA NUOVA ISTANZA E DANDOGLI DEI VALORI AD OGNI SINGOLO ELEMENTO */
        foreach ($services as $service) {

            $new_service = new Service();

            $new_service->label = $service['label'];
            $new_service->icon = $service['icon'];

            $new_service->save();


             /* CREO UN ARRAY CHE SELEZIONE CASUALEMENTE GLI ID DEL MODEL APARTMENT */
            $service_apartments = array_filter($apartments_ids, fn () => rand(0, 1));

            
            /* ATTACCO I RECORD DEI SERVIZI AGLI APPARTAMENTI */
            $new_service->apartments()->attach($service_apartments);
        }
    }
}