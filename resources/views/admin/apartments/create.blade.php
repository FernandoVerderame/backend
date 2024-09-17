@extends('layouts.app')

@section('title', 'Aggiungi appartamento')

@section('content')
    {{-- INCLUDO FORM --}}
    @include('includes.apartment.form')
@endsection

@section('scripts')
    {{-- JS PREWIEW IMMAGINE --}}
    @vite('resources/js/image_preview.js')
    {{-- JS INDIRIZZO --}}
    @vite('resources/js/address.js')
@endsection
