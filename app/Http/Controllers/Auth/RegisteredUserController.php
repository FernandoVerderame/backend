<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before_or_equal:' . now()->subYears(18)->format('d-m-Y')],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Il nome è obbligatorio',
            'name.max' => 'Il nome deve avere un massimo di :max caratteri',
            'birthday.required' => 'Il campo data di nascita è obbligatorio.',
            'birthday.date' => 'Il campo data di nascita deve essere una data valida.',
            'birthday.before_or_equal' => 'Devi avere almeno 18 anni per registrarti.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.string' => 'Il campo email deve essere una stringa.',
            'email.lowercase' => 'L\'email deve essere in minuscolo.',
            'email.email' => 'Il campo email deve essere un indirizzo email valido.',
            'email.max' => 'Il campo email non può superare i 255 caratteri.',
            'email.unique' => 'L\'indirizzo email specificato è già stato utilizzato.',
            'password.required' => 'Il campo password è obbligatorio.',
            'password.confirmed' => 'La conferma della password non corrisponde.',
            'password.password' => 'La password deve contenere almeno otto caratteri, includendo almeno una lettera maiuscola, una lettera minuscola, un numero e un carattere speciale.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
