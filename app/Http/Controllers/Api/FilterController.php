<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class FilterController extends Controller
{

    /* FUNZIONE PER OTTENERE UN ELENCO DI APPARTAMENTI FILTRATI */
    public function index(Request $request)
    {

        /* RECUPERO TUTTI I VALORI DELLA RICHIESTA */
        $filters = $request->all();


        /* IMPOSTO IL RAGGIO A 20KM SE NON SPECIFICO */
        $radius = $filters['radius'] ?? 20000;


        /* VERIFICO SE NELLA RICHIESTA SONO PRESENTI LATITUDINE E LONGITUDINE */
        if (!isset($filters['lat']) || !isset($filters['lon'])) return response('Latitude and Longitude are required.', 400);


        /* CALCOLO LA DISTANZA TRA LATITUDINE E LONGITUDINE FORNITE DALL'UTENTE, PER FILTRARE GLI APPARTAMENTI ENTRO IL RAGGIO SPECIFICO */
        $query = Apartment::selectRaw("*, ST_Distance_Sphere(POINT({$filters['lon']}, {$filters['lat']}), POINT( `longitude`, `latitude`)) AS `distance`");


        /* APPARTAMENTI SOLO PUBBLICATI */
        $query->where('is_visible', 1);


        /* PASSO I SERVIZI */
        $query->with('services');


        /* CONDIZIONE PER IL NUMERO DI STANZE */
        if (isset($filters['rooms'])) {
            $query->where('rooms', '>=', $filters['rooms']);
        }


        /* CONDIZIONE PER NUMERO DI LETTI */
        if (isset($filters['beds'])) {
            $query->where('beds', '>=', $filters['beds']);
        }


        /* CONDIZIONE PER I SERVIZI */
        if ($request->has('services')) {
            /* CREO ARRAY DI ID */
            $serviceIds = explode(',', $request->services);
            /* CICLO SUGLI ARRAY */
            foreach ($serviceIds as $serviceId) {
                /* CONTROLLO CHE GLI ID SIANO CORRISPONDENTI */
                $query->whereHas('services', function ($q) use ($serviceId) {
                    $q->where('services.id', $serviceId);
                });
            }
        }


        /* DISTANZA */
        $query->having('distance', '<', $radius);


        /* ORIDINO GLI APPARTAMENTI IN BASE ALLA DISTANZA */
        $query->orderBy('distance');


        /* OTTENGO GLI APPARTMANETI CON EVENTUALI FILTRI */
        $apartments = $query->get();

        // Modifica l'URL della copertina per ogni appartamento se esiste
        $apartments->transform(function ($apartment) {
            if ($apartment->cover) {
                $apartment->cover = url('storage/' . $apartment->cover);
            }
            return $apartment;
        });


        /* RESTITUISCO GLI APPARATMENTI TROVATI */
        return $apartments;
    }
}
