@extends('layouts.app')

@section('title', 'Registrati')

@section('login-form')

    <section id="login-form">
        <div class="row" id="row-login">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="row justify-content-center">
                    <div class="col">
                        {{-- CARD REGISTRAZIONE --}}
                        <div class="card rounded-4">
                            <div class="card-header border-bottom-0  bg-white white px-3 py-0 pt-3">
                                <img src="{{ Vite::asset('resources/img/minologo.png') }}" alt="">
                                <h3 class="mt-4">Benvenuto</h3>
                                <p>Gestisci i tuoi appartamenti con Holiday Houses</p>
                            </div>
                            <div class="card-body py-0">
                                <form method="POST" action="{{ route('register') }}" novalidate>
                                    @csrf
                                    <div class="mb-2 row">
                                        <div class="col">
                                            <label for="name"
                                                class=" col-form-label text-md-right">{{ __('Nome Utente') }}</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col">
                                            <label for="birthday"
                                                class=" col-form-label text-md-right">{{ __('Data di Nascita') }}</label>
                                            <input id="birthday" type="date"
                                                class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                                                value="{{ old('birthday') }}" required autocomplete="birthday" autofocus>

                                            @error('birthday')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col">
                                            <label for="email"
                                                class=" col-form-label text-md-right">{{ __('E-Mail') }}*</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col">
                                            <label for="password"
                                                class=" col-form-label text-md-right">{{ __('Password') }}*</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col">
                                            <label for="password-confirm"
                                                class=" col-form-label text-md-right">{{ __('Conferma Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="mb-2 row mb-0">
                                        <div class="col">
                                            <button type="submit" class="btn bg-hover w-100 text-white">
                                                {{ __('Continua') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="mb-2 row mb-0">
                                    <div class="col d-flex gap-1">
                                        <p>Hai già un account?</p><a href="{{ route('welcome') }}"
                                            class="text-decoration-none"><span class="c-main ">Accedi</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 d-none d-lg-block text-end" id="img-login"></div>
        </div>
    </section>

@endsection
