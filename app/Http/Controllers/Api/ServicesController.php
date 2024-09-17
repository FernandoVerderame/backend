<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;


class ServicesController extends Controller
{

    /* FUNZIONE PER RECUPERARE TUTTI I SERVIZI */
    public function index(Request $request)
    {

        /* RECUPERO TUTI I SERVIZI DAL DATABASE */
        $services = Service::all();

        
        /* RESTITUISCO IN FORMATO JSON */
        return response()->json($services);
    }
}