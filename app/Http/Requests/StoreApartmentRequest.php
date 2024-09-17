<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        /* RESTITUISCO CIO' CHE DA ERRORE */
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'rooms' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'sqm' => 'required|integer|min:1',
            'cover' => 'nullable|image:jpg, jpeg, png, svg, webp, pdf',
            'address' => 'required|string',
            'latitude' => 'required|decimal:0,6',
            'longitude' => 'required|decimal:0,6',
            'is_visible' => 'nullable|boolean',
            'services' => 'required|exists:services,id',
        ];
    }

    public function messages(): array
    {

        /* RESTITUISCO CIO' CHE DARA' IL MESSAGGIO DI ERRORE */
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo non è valido',

            'description.required' => "La descrizone dell'appartamento è obbligatorio",

            'rooms.required' => 'Il numero di stanze è obbligatorio',
            'rooms.integer' => 'Inserisci un numero valido',
            'rooms.min' => 'Inserisci un numero maggiore di uno',

            'beds.required' => 'Il numero di letti è obbligatorio',
            'beds.integer' => 'Inserisci un numero valido',
            'beds.min' => 'Inserisci un numero maggiore di uno',

            'bathrooms.required' => 'Il numero di bagni è obbligatorio',
            'bathrooms.integer' => 'Inserisci un numero valido',
            'bathrooms.min' => 'Inserisci un numero maggiore di uno',

            'sqm.required' => 'Il numero di metri quadri è obbligatorio',
            'sqm.integer' => 'Inserisci un numero valido',
            'sqm.min' => 'Inserisci un numero maggiore di zero',

            'address.required' => 'L\'indirizzo è obbligatorio',
            'address.string' => 'L\'indirizzo non è valido',
            'latitude.required' => 'Indirizzo non valido',
            'longitude.required' => 'Indirizzo non valido',

            'cover.image' => "l\'immagine inserita non è valida",

            'is_visible.boolean' => 'Il valore non è valido',

            'services.required' => 'Inserisci almeno un servizio',
            'services.exists' => 'Il servizio è inesistente',
        ];
    }
}