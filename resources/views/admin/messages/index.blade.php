@extends('layouts.app')

@section('title', 'Messages')

@section('content')

    

        
            {{-- TITOLO --}}
            <h2 class="mt-5">Lista Messaggi</h2>

            {{-- TABELLA --}}
            <table class="table table-white table-hover mt-5 shadow border">
    
                {{-- HEADER TABELLA --}}
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titolo</th>
                        <th scope="col" class="d-none d-lg-table-cell">Contenuto</th>
                        <th scope="col">Email</th>
                        <th scope="col">Appartamento</th>
                        <th scope="col" class="d-none d-lg-table-cell">Data</th>
                    </tr>
                </thead>
    
                {{-- BODY TABELLA --}}
                <tbody>
                    @forelse ($messages as $message)
                        <tr>
                            {{-- ID --}}
                            <th >{{ $message->id }}</th>
    
                            {{-- TITOLO--}}
                            <td>{{ $message->name }}</td>
    
                            {{-- CONTENUTO --}}
                            <td class="d-none d-lg-table-cell">{{ $message->text }}</td>
    
                            {{-- EMAIL --}}
                            <td>{{ $message->email }}</td>
    
                            {{-- APPARATEMNTO CORRISPONDENTE --}}
                            <td>{{ $message->apartment_id }}</td>
    
                            {{-- DATA MESSAGGIO RICEVUTO --}}
                            <td class="d-none d-lg-table-cell">{{ $message->getDate('created_at') }}</td>
                        </tr>
    
                        {{-- ALTRIMENTI --}}
                    @empty
                           <h3>Non ci sono messaggi</h3>
                    @endforelse
                </tbody>
            </table>
        

    

@endsection