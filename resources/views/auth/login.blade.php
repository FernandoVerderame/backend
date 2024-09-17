@extends('layouts.app')

@section('title', 'Accedi')

@section('login-form')

<section id="login-form">
    <div class="row" id="row-login">
        <div class="col d-flex justify-content-center align-items-center">
            <div class="row justify-content-center">
                <div class="col">
                    {{-- CARD LOGIN --}}
                    <div class="card rounded-4 p-0">
                        <div class="card-header border-bottom-0  bg-white white px-3 py-0 pt-3">
                            <img src="{{ Vite::asset('resources/img/minologo.png') }}" alt="">
                            <h3 class="mt-4">Bentornato</h3>
                            <p>Gestisci i tuoi appartamenti con Holiday Houses</p>
                        </div>
                        <div class="card-body px-3 py-0">
                            <form method="POST" action="{{ route('login') }}" novalidate>
                                @csrf
                                <div class="mb-4 row">
                                    <div class="col">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-right">E-mail</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <div class="col">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Ricordami') }}
                                            </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link p-0 c-main text-decoration-none mt-2"
                                                href="{{ route('password.request') }}">
                                                {{ __('Ho dimenticato la password') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-4 row mb-0">
                                    <div class="col">
                                        <button type="submit" class="btn bg-hover w-100 text-white">
                                            {{ __('Continua') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            {{-- REGISTRAZIONE --}}
                            <div class="mb-4 row mb-0">
                                <div class="col d-flex gap-1">
                                    <p>Non hai un account?</p><a href="{{ route('register') }}"
                                        class="text-decoration-none"><span class="c-main ">Registrati</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col d-none d-lg-block text-end" id="img-login">
        </div>
    </div>
</section>
@endsection