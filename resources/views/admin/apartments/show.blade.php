@extends('layouts.app')

@section('title', 'Appartamento')

@section('content')

    <div class="d-flex align-items-center justify-content-between mt-4">
        {{-- NAVIGAZIONE PAGINE --}}
        <nav class="d-flex align-items-center">
            <ol class="breadcrumb m-0">
                <li><span><i class="fa-solid fa-chevron-left me-2 fs-5 mt-1"></i></span></li>
                <li class="breadcrumb-item"><a class="color-link" href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="color-link" href="{{ route('admin.apartments.index') }}">Appartamenti</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Dettaglio appartamento
                </li>
            </ol>
        </nav>
        {{-- MODIFICA --}}
        <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn bg-hover text-white p-2"><i
                class="fa-regular fa-pen-to-square me-2"></i> Modifica</a>
    </div>
    <div class="row mt-5 gap-4">
        <div class="col">
            <section id="detail">
                <div class="card rounded-4   p-4">
                    {{-- TITOLO APPARTAMENTO --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1>{{ $apartment->title }}</h1>
                        {{-- BOTTONE MAPPA --}}
                        <button type="button" id="map-button" class="bg-hover text-white btn" data-bs-toggle="modal"
                        data-bs-target="#mapModal">
                        <span class="d-none d-md-inline">Mostra la mappa</span> <i class="fa-solid fa-map ms-1"></i>
                        </button>
                    </div>
                    {{-- IMMAGINE DI COPERTINA --}}
                    <div class="thumb-img">
                        {{-- <img src="{{ $apartment->cover }}" alt="{{ $apartment->title }}" class="img-fluid"> --}}
                        <img src="{{ Vite::asset('public/storage/' . $apartment->cover) }}" alt="" class="img-fluid table-img rounded-1">
                    </div>
                    <div class="card-body">
                        {{-- DESCRIZIONE APPARTAMENTO --}}
                        <h2 class="card-title mb-3">Descrizione appartamento</h2>
                        <p class="card-text">
                            {{ $apartment->description }}
                            {{-- INDIRIZZO --}}
                        <div class="road fw-bold">
                            <i class="fa-solid fa-location-dot me-2"></i>{{ $apartment->address }}
                        </div>
                    </p>
                        {{-- DETTAGLI DELL'APPARTAMENTO --}}
                        <h2 class="card-title mt-5 mb-2">Dettaglio appartamento</h2>
                        <div class="fw-medium stats mb-2">Come è composto</div>
                        <ul class="d-flex gap-3">
                            <li>
                                <span class="badge fw-medium"><i class="fa-solid fa-door-closed me-2"></i>
                                    {{ $apartment->rooms }} camere</span>
                            </li>
                            <li>
                                <span class="badge fw-medium"><i class="fa-solid fa-bath me-2"></i>
                                    {{ $apartment->bathrooms }} bagni</span>
                            </li>
                            <li>
                                <span class="badge fw-medium"><i class="fa-solid fa-ruler-horizontal me-2"></i>
                                    {{ $apartment->sqm }} mq</span>
                            </li>
                            <li>
                                <span class="badge fw-medium"><i class="fa-solid fa-bed me-2"></i> {{ $apartment->rooms }}
                                    letti</span>
                            </li>
                        </ul>
                        {{-- STATISTECHE --}}
                        <div class="fw-medium stats mt-4 mb-2">Statistiche</div>
                        <ul class="d-flex gap-3">
                            <li>
                                <span class="badge fw-medium"><i class="fa-regular fa-eye me-2"></i>
                                    {{ $apartment->viewsCount() }}</span>
                            </li>
                            <li>
                                <span class="badge fw-medium"><i
                                        class="fa-regular fa-envelope me-2"></i>{{ $apartment->messagesCount() }}</span>
                            </li>
                        </ul>
                        {{-- STATO PUBBLICAZIONE --}}
                        <div class="mt-5 fs-5">{!! $apartment->is_visible
                            ? '<i class="fa-solid fa-circle-check text-success me-2"></i> <span class="text-success fw-bold">Pubblicato</span>'
                            : '<i class="fa-solid fa-circle-xmark text-danger"></i> <span class="text-danger fw-bold">Non pubblicato</span>' !!}</div>
                    </div>
                    <section id="messages">
                        <h2 class="text-center">Messaggi <i class="fa-solid fa-comments"></i></h2>
                        <div>
                            <div class="message-list accordion accordion-flush" id="accordionFlushExample">
                                @forelse ($apartment->messages as $message)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button d-flex flex-column align-items-start collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $message->id }}" aria-expanded="false"
                                                aria-controls="flush-collapse{{ $message->id }}">
                                                Messaggio ricevuto da {{ $message->name }}
                                                <div class="text-gradient mt-2" style="font-size: 12px">
                                                    {{ $message->created_at->format('d/m/y') }}
                                                    alle
                                                    {{ $message->created_at->format('H:i') }}
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $message->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p>{{ $message->text }}</p>
                                                <hr>
                                                <div><i class="fa-solid fa-envelope"></i> <i> {{ $message->email }} </i></div>
        
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    {{-- MESSAGGI --}}
                                    <div>
                                        Non hai ricevuto nessun messaggio, promuovi i tuoi boolbnb con boolbnb premium per ottenere
                                        più visualizzazioni!
                                        <a href="{{ route('admin.apartments.sponsor', $apartment->id) }}" class="button-primary">Vedi di più</a>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                </div>
            </section>
            
        </div>
        <div class="col col-lg-4">
            <section id="services">
                <div class="card rounded-4 p-3">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Servizi appartamento</h2>
                        <ul class="p-0 m-0">
                            {{-- CICLO SU I SERVIZI --}}
                            @foreach ($services as $service)
                                {{-- CONTROLLO SE I SERVIZI ASSOCIATI ALL'APPARTEMENTO CONTEGONO QUEL DETERMINATO SERVIZIO --}}
                                @if ($apartment->services->contains($service))
                                    <li class="fw-medium mb-3 d-flex gap-3 align-items-center fs-5">
                                        <i class="fa-solid fa-circle-check icon-show"></i>
                                        <span class="material-symbols-outlined">{{ $service->icon }}</span>
                                        {{ $service->label }}
                                    </li>
                                    {{-- SERVIZI NON INCLUSI --}}
                                @else
                                    <li class="fw-medium mb-3 d-flex gap-3 align-items-center fs-5 disable">
                                        <i class="fa-regular fa-circle text-secondary"></i>
                                        <span class="material-symbols-outlined ">{{ $service->icon }}</span>
                                        {{ $service->label }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
            {{-- CICLO CHE HA COME CONDIZIONE DI VERIFICARE SE GLI SPONSOR SONO ASSOCIATIO AGLI APPARTAMENTI --}}
            @forelse ($apartment->sponsors as $sponsor)
                {{-- CARD SPONSORIZZAZZIONE --}}
                <section id="sponsor">
                    <div class="card rounded-4 p-3 mt-4 bg-card">
                        <div class="card-body">
                            <h2 class="card-title mb-4">Sponsorizzazione</h2>
                            <div class="subscription fw-bold"><i class="fa-regular fa-circle-check"></i> Appartamento Sponsorizzato</div>
                            <div class="mb-3">
                                <a href="{{ route('admin.apartments.sponsor', $apartment->id) }}"
                                    class="btn bg-hover text-white p-2 mt-3 me-2">Aggiugi Piano</a>
                                <a href="{{ route('admin.apartments.sponsor', $apartment->id) }}" class="btn c-main bg-hover-rev p-2 mt-3">Descrizione abbonamento</a>
                            </div>
                        </div>
                    </div>
                </section>
            {{-- ALTRIMENTI --}}
            @empty
                {{-- CARD DA SPONSORIZZARE --}}
                <section id="promo">
                    <div class="card rounded-4 mt-4">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center gap-2">
                                <div class="card-image">
                                    <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="nav-logo">
                                </div>
                                <h3 class="fw-bolder m-0">BoolBNB Plus</h3>
                            </div>
                            <p class="fw-bold mt-3">Prova Airbnb Plus e scopri i vantaggi dei nostri piani</p>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.apartments.sponsor', $apartment->id) }}"
                                    class="btn bg-hover text-white p-2 mt-3">Scopri i piani</a>
                            </div>
                        </div>
                    </div>
                </section>
            @endforelse
        </div>
        {{-- MODALE MAPPA --}}
        @include('map.includes.map')
    </div>
    
@endsection

@section('scripts')
    @vite( 'resources/js/map-show.js')
@endsection
