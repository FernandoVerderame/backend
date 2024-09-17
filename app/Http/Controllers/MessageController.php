<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        /* RECUEPRO I MESSAGGI ASSOCIATI AGLI APPARAMENTI DELL'UTENTE AUTENTICATO */
        $messages = Message::whereRelation('apartment', 'user_id', Auth::id())->get();


        /* RESTITUISCI IN PAGINA */
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        /* CREO UNA NUOVA ISTANZA PER EVENTUALI ERRORI */
        $message = new Message();

        return view('admin.messages.create', compact('message'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /* RECUPERO I DATI E FACCIO LA VALIDAZIONE */
        $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'text' => 'required'
            ],
            [
                'name.required' => 'Il titolo è obbligatorio',
                'email.required' => 'La mail è obbligatoria',
                'email.email' => 'La mail non è scritta nel formato giusto',
                'text.required' => 'Il contenuto è obbligatorio'
            ]
        );

        
        /* CREO UNA NUOVA ISTANZA */
        $message = new Message();


        /* POPOLO L'OGGETTO CON I VALORI DELL'ARRAY DATA */
        $message->fill($data);

        
        /* SALVATAGGIO */
        $message->save();


        /* RSTITUISCO IN PAGINA */
        return to_route('admin.messages.index')->with('message', 'Messaggio creato con successo')->with('type', 'success');
    }
}