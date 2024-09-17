{{-- SE ESTISTE UN APPARTAMENTO --}}
@if ($apartment->exists)
    {{-- SALVATAGGIO MODIFICHE --}}
    <form action="{{ route('admin.apartments.update', $apartment) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
@else
    {{-- SALVATAGGIO DI CREAZIONE --}}
    <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
@endif
@csrf

{{-- NAVIGAZIONE PAGINE --}}
<div class="d-flex align-items-center justify-content-between mt-4">
    <nav class="d-flex align-items-center">
        <ol class="breadcrumb m-0">
            <li><span><i class="fa-solid fa-chevron-left me-2 fs-5 mt-1"></i></span></li>
            <li class="breadcrumb-item"><a class="color-link" href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="color-link" href="{{ route('admin.apartments.index') }}">Appartamenti</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $apartment->exists ? 'Modifica appartamento' : 'Aggiungi appartamento' }}
            </li>
        </ol>
    </nav>
    {{-- BOTTONE SALVA --}}
    <button class="btn bg-hover text-white" id="save-btn" type="submit"><i class="fa-solid fa-floppy-disk me-2"></i>Salva</button>
</div>

{{-- CONTENUTO FORM --}}
<div class="row mt-3 mb-5">
    {{-- PRIMA COLONNA --}}
    <div class="col-lg-6">
        {{-- CARD INFO APPARTAMENTO --}}
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title mt-4">Info appartamento</h2>
                {{-- CONTENUTO CARD --}}
                <div class="d-flex gap-4 mt-3">
                    {{-- NOME APPARTAMENTO --}}
                    <div class="col-5">
                        <div class="mb-3">
                            <label for="title" class="form-label"> Nome Appartamento <span
                                    class="form-text text-danger">*</span></label>
                            <div class="input-container">
                                <input type="text"
                                    class="form-control form @error('title') is-invalid @elseif (old('title', '')) is-valid @enderror"
                                    id="title" name="title" value="{{ old('title', $apartment->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @else
                                    <i class="fa-solid fa-house-chimney icon"></i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- INDIRIZZO --}}
                    <div class="col-5">
                        <label for="address-search" class="form-label"> Indirizzo <span
                                class="form-text text-danger">*</span></label>
                        <div class="d-block card-data">
                            <div class="input-container">
                                <input id="search-address" name="address" autocomplete="off"
                                    value="{{ old('address', $apartment->address) }}" type="text"
                                    class="form-control @error('address') is-invalid @enderror">
                                @error('address')
                                    <span class="invalid-feedback error-message" role="alert">{{ $message }}</span>
                                @else
                                    <i class="fa-solid fa-location-dot icon"></i>
                                @enderror
                                <ul id="suggestions" class="suggestions-list"></ul>
                            </div>
                            <span id="address-error" class="text-danger error-message"></span>
                            <input type="hidden" name="latitude" id="latitude"
                                value="{{ old('latitude', $apartment->latitude) }}">
                            <input type="hidden" name="longitude" id="longitude"
                                value="{{ old('longitude', $apartment->longitude) }}">
                        </div>
                    </div>
                </div>
                <h2 class="mt-4">Dettagli appartamento</h2>
                <div class="d-flex gap-4 mt-3">
                    {{-- CAMERE --}}
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="rooms" class="form-label">Camere <span
                                    class="form-text text-danger">*</span></label>
                            <div class="input-container">
                                <input type="number"
                                    class="form-control @error('rooms') is-invalid @elseif (old('rooms', '')) is-valid @enderror"
                                    id="rooms" name="rooms" value="{{ old('rooms', $apartment->rooms) }}"
                                    min="0">
                                @error('rooms')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @else
                                    <i class="fa-solid fa-door-open icon"></i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- LETTI --}}
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="beds" class="form-label">Letti <span
                                    class="form-text text-danger">*</span></label>
                            <div class="input-container">
                                <input type="number"
                                    class="form-control @error('beds') is-invalid
                                @elseif (old('beds', '')) is-valid 
                                @enderror"
                                    id="beds" name="beds" value="{{ old('beds', $apartment->beds) }}"
                                    min="0">
                                @error('beds')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @else
                                    <i class="fa-solid fa-bed icon"></i>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-4 mt-3">
                    {{-- BAGNI --}}
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="bathrooms" class="form-label">Bagni <span
                                    class="form-text text-danger">*</span></label>
                            <div class="input-container">
                                <input type="number"
                                    class="form-control @error('bathrooms') is-invalid
                                @elseif (old('bathrooms', '')) is-valid 
                                @enderror"
                                    id="bathrooms" name="bathrooms"
                                    value="{{ old('bathrooms', $apartment->bathrooms) }}" min="0">
                                @error('bathrooms')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @else
                                    <i class="fa-solid fa-bath icon"></i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- METRI QUADRI --}}
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="sqm" class="form-label">Metri Quadrati <span
                                    class="form-text text-danger">*</span></label>
                            <div class="input-container">
                                <input type="number"
                                    class="form-control @error('sqm') is-invalid
                                @elseif (old('sqm', '')) is-valid 
                                @enderror"
                                    id="sqm" name="sqm" value="{{ old('sqm', $apartment->sqm) }}"
                                    min="0">
                                @error('sqm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @else
                                    <i class="fa-solid fa-ruler-horizontal icon"></i>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                {{-- IMMAGINE --}}
                <h2 class="mt-4">Media</h2>
                <div class="col-9">
                    <div class="mt-3">
                        <label for="cover" class="form-label">Immagine </label>
                        {{-- BOTTONE CAMBIA IMMAGINE --}}
                        <div class="input-group mb-3 @if (!$apartment->cover) d-none @endif"
                            id='previous-image-field'>
                            <button class="btn btn-outline-secondary" type="button" id="change-image-button">Cambia
                                Immagine</button>
                            <input type="text" class="form-control" value="{{ old('cover', $apartment->cover) }}"
                                disabled>
                        </div>
                        {{-- BOTTONE CARICA FILE --}}
                        <input type="file"
                            class="form-control @if ($apartment->cover) d-none @endif @error('cover') is-invalid @elseif (old('cover', '')) is-valid @enderror"
                            name='cover' id="cover">
                        @error('cover')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                {{-- PREVIEW IMMAGINE --}}
                <div class="col">
                    <div class="mt-3">
                        
                        <img style="width: 225px; height: 225px" src="{{ old('cover', $apartment->cover) ?  Vite::asset('public/storage/' . $apartment->cover)  : 'https://marcolanci.it/boolean/assets/placeholder.png' }}"
                            class="img-fluid rounded-3" alt="{{ $apartment->cover ? $apartment->title : 'preview' }}"
                            id='preview'>
                    </div>
                </div>
                {{-- SWITCH PUBBLICAZIONE --}}
                <div class="col-12 my-5">
                    <div class="form-check form-switch">
                        <input value="1" type="checkbox" class="form-check-input form" id="is_visible"
                            name="is_visible" role="button" @if (old('is_visible', $apartment->is_visible)) checked @endif>
                        <label for="is_visible" class="form-check-label">Pubblica</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-lg-6">
            {{-- CARD DESCRIZIONE APPARTAMENTO --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title mt-4">Descrizione appartamento</h2>
                    {{-- CONTENUTO CARD --}}
                    <div class="mt-3">
                        <label for="description" class="form-label">Descrizione <span
                            class="form-text text-danger">*</span></label>
                            <textarea
                            class="form-control @error('description') is-invalid
                            @elseif (old('description', '')) is-valid 
                            @enderror"
                            id="description" name="description" rows="8">{{ old('description', $apartment->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                </div>
            </div>
            
            {{-- CARD SERVIZI APPARTAMENTO --}}
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mt-4">Servizi appartamento</h2>
                    {{-- CONTENUTO CARD --}}
                    <div class="mb-3">
                        <div class="form-group @error('services') is-invalid 
                        @enderror">
                            <ul class="p-0">
                                @foreach ($services as $service)
                                    <li class="m-3">
                                        <div class="form-check form-check-inline d-flex align-items-center gap-3 fs-5">
                                            <input class="form-check-input" type="checkbox" id="{{ $service->id }}"
                                                value="{{ $service->id }}" name="services[]"
                                                @if (in_array($service->id, old('services', $array_services))) checked @endif>
                                            <span class="material-symbols-outlined">{{ $service->icon }}</span>
                                            <label class="form-check-label"
                                                for="{{ $service->id }}">{{ $service->label }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @error('services')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
