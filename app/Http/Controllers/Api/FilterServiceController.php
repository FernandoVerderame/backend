<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;;

class FilterServiceController extends Controller
{

    /* FUNZIONE PER I SERVIZI */
    public function __invoke(string $id)
    {

        /* CERCO NEL DATABASE IL SERVIZIO CON ID FORNITO */
        $service = Service::whereId($id)->first();


        /* MESSAGGIO DI 404 SE IL SERVIZIO NON ESISTE */
        if (!$service) return response(null, 404);


        /* ID DEL SERVIZIO */
        $service_id = $service->id;


        /* SELEZIONO GLI APPARATMANETI VISIBILI IN BASE AI SERVIZIONI SPECIFICI CHE OFFRONO */
        $apartments = Apartment::whereIsVisible(true)->whereHas('services', function ($query) use ($service_id) {
            $query->where('service_id', $service_id);
        })->with('services')->get();


        /* RESTITUISCO GLI APPARTAMENTI IN FORMATO JSON */
        return response()->json(['apartments' => $apartments]);
    }
}