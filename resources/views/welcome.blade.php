@extends('layouts.app')

@section('content')

    {{-- UTENTE AUTENTICATO --}}
    @auth
        {{-- INCLUDO PANNELLO DI CONTROLLO --}}
        @include('admin.dashboard')
    @endauth



    {{-- UTENTE NON AUTENTICATO --}}
    @guest

    @section('login-form')
        @include('auth.login')
    @endsection
    @endguest

@endsection
