@extends('layouts.app')

@section('title', 'Cestino')

@section('content')

    {{-- NAVIGAZIONE PAGINE --}}
    <nav class="mt-3">
        <ol class="breadcrumb">
            <li><span><i class="fa-solid fa-chevron-left me-2 fs-5 mt-1"></i></span></li>
            <li class="breadcrumb-item"><a class="color-link" href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="color-link" href="{{ route('admin.apartments.index') }}">Appartamenti</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Cestino
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center my-4">
        <h3 class="mb-0">Cestino</h3>
        <div class="d-flex justify-content-end align-items-center gap-2">
            {{-- RIPRISTINA TUTTO --}}
            <form action="{{ route('admin.apartments.returned') }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn bg-hover me-2 text-white p-2"><i class="fa-solid fa-rotate"></i>
                    Ripristina tutto</button>
            </form>
        </div>
    </div>
    {{-- SE IL CONTEGGIO DEGLI APPARTAMENTI E' MAGGIORE DI 0 --}}
    @if ($apartments->count() > 0)
        {{-- TABELLA APPARTAMENTI --}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-start">Anteprima</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Pubblicato</th>
                    <th scope="col">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        {{-- COVER --}}
                        <td class="text-start"><img src="{{ $apartment->cover }}" alt="{{ $apartment->title }}"
                                class="img-fluid table-img rounded-1"></td>

                        {{-- TITOLO --}}
                        <td>{{ $apartment->title }}</td>

                        {{-- STATO --}}
                        <td class="text-start fs-4">{!! $apartment->is_visible
                            ? '<i class="fa-solid fa-circle-check text-success"></i>'
                            : '<i class="fa-solid fa-circle-xmark text-danger"></i>' !!}</td>
                        <td>
                            <div class="d-flex justify-content-end align-items-center gap-1">
                                {{-- RIPRISTINA SINGOLO APPARTAMENTO --}}
                                <form action="{{ route('admin.apartments.restore', $apartment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn bg-icon"><i class="fa-solid fa-rotate"></i></button>
                                </form>
                            </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ALTRIMENTI --}}
    @else
        <h2 class=" text-center">Cestino vuoto</h2>
    @endif

@endsection
