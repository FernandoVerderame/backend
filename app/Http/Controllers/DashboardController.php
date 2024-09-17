<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Message;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {

        /* IMPOSTO LA LINGUA IN ITALIANO */
        Carbon::setLocale('it');


        /* RECUEPRO GLI APPARATEMNTI DELL'UTENTE AUTENTICATO */
        $apartments = Apartment::where('user_id', Auth::id())->get();


        /* CREO VARIABILI DA MANIPOLARE PER MESSAGGI E VISSULIAZZAZIONI */
        $totalMessages = 0;
        $totalViews = 0;


        /* CICLO SUGLI APPARAMENTI */
        foreach ($apartments as $apartment) {

            /* TOTLALE DI TUTTI I MESSAGGI DEGLI APPARTAMENTI */
            $totalMessages += $apartment->messages()->count();

            /* TOTLALE DI TUTTE LE VISSUALIZZAZZIONI DEGLI APPARTAMENTI */
            $totalViews += $apartment->views()->count();
        }


        /* CREO ARRAY DA MANIPOLARE PER MEMORIZZARE IL NUMERO DI VISSULAIZZAZIONI PER OGNI MESI DI TUTTI GLI APPARAEMNTI */
        $month_views = [];

        /* CICLO PER 12 INCREMENTANDO DI 1 OGBI GIRO */
        for ($month = 1; $month <= 12; $month++) {

            /* QUERY PER CONTARE IL NUMERO DI VISSUALIZZAZZIONI PER IL MESE CORRENTE E PER GLI APPARAMENTI DELL'UTENTE AUTENTICATO */
            $viewsCount = View::whereMonth('created_at', $month)
                ->whereIn('apartment_id', $apartments->pluck('id'))
                ->count();


            /* AGGIUNGI ALL'ARRAY IL NUEMRO DI VISSUALIZZAZZIONI */
            $month_views[] = $viewsCount;
        }

        /* CREO ARRAY DA MANIPOLARE PER MEMORIZZARE IL NUMERO DI MESSAGGI PER OGNI MESI DI TUTTI GLI APPARAEMNTI */
        $month_messages = [];

        /* CICLO PER 12 INCREMENTANDO DI 1 OGBI GIRO */
        for ($month = 1; $month <= 12; $month++) {

            /* QUERY PER CONTARE IL NUMERO DI MESSAGGI PER IL MESE CORRENTE E PER GLI APPARAMENTI DELL'UTENTE AUTENTICATO */
            $messagesCount = Message::whereMonth('created_at', $month)
                ->whereIn('apartment_id', $apartments->pluck('id'))
                ->count();

            /* AGGIUNGI ALL'ARRAY IL NUEMRO DI MESSAGGI */
            $month_messages[] = $messagesCount;
        }


        /* RESTITUSCI I DATI */
        return view('welcome', compact('apartments', 'totalMessages', 'totalViews', 'month_views', 'month_messages'));
    }
}
