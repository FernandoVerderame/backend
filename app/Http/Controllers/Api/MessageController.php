<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    /* FUNZIONE PER OTTERE TUTI I MESSAGGI */
    public function index()
    {

        /* RECUPERO TUTTI I MESSAGGI DAL DATABASE */
        $messages = Message::all();


        /* CALCOLO IL NUMERO DI TUTTI I MESSAGGI */
        $total = count($messages);


        /* RESTITUISCO I MESSAGGI E IL NUMERO TOTALE IN FORMATO JSON */
        return response()->json(compact('messages', 'total'));
    }


    /* FUNZIONE PER MEMORIZZARE NEL DATABASE UN NUOVO MESSAGGIO */
    public function store(Request $request)
    {

        /* RECUPERO TUTTI I DATI DELLA RICHIESTA */
        $data = $request->all();


        /* VALIDAZIONE */
        $validator = Validator::make(
            $data,
            [
                'name' => 'required',
                'email' => 'required|email',
                'text' => 'required',
                'apartment_id' => 'nullable|exists:apartments,id'
            ],
            [
                'name.required' => 'Il titolo è obbligatorio',
                'email.required' => 'La mail è obbligatoria',
                'email.email' => 'La mail non è scritta nel formato giusto',
                'text.required' => 'Il contenuto è obbligatorio',
                'apartment_id.exists' => "L'appartamento è inesistente",
            ]
        );


        /* SE LA VALIDAZIONE FALLISCE MESSAGGIO 400 */
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        /* CREZIONE DI UNA NUOVA ISTANZA DI MESSAGGIO */
        $message = new Message();


        /* RECUPERO TUTTI I DATI DELLA RICHIESTA */
        $message->fill($data);

        
        /* SALVATAGGIO */
        $message->save();


        /* RESTITUISCO MESSAGGIO DI SUCCESSO 204 */
        return response(null, 204);
    }
}