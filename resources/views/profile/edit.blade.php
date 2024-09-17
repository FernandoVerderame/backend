@extends('layouts.app')

@section('title', 'Prifilo Utente')

@section('content')

    <div class="container">
        <h1 class=" my-4">
            {{ __('Profilo') }}
        </h1>
        <hr>
        <div class="row mb-5">
            <div class="col-6 mt-5 d-flex justify-content-center align-items-center">
                <div class="profile-photo ">
                    <img src=" https://marcolanci.it/boolean/assets/placeholder.png" alt="foto-profilo" class="w-100 rounded-circle">

                </div>
            </div>
            <div class="col-6">

                <div class="card p-4 bg-white shadow rounded-lg">

                    @include('profile.partials.update-profile-information-form')
        
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-6">
        
                <div class="card p-4 mb-4 bg-white shadow rounded-lg">
        
        
                    @include('profile.partials.update-password-form')
        
                </div>
            </div>
            <div class="col-6">

                <div class="card p-4 mb-4 bg-white shadow rounded-lg">
        
        
                    @include('profile.partials.delete-user-form')
        
                </div>
            </div>
        
        </div>
        
    </div>

@endsection
