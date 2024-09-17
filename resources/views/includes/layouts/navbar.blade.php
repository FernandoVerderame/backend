{{-- NAVBAR --}}
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center me-3" href="{{ url('/') }}">
            <div class="logo_laravel d-flex align-items-center justify-content-center">
                <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="" class="img-fluid me-1" id="nav-logo">
                <span id="link-logo">Holiday Houses</span>
            </div>
        </a>
        <div class="d-flex align-items-center gap-3">
            {{-- MESSAGGI FUORI DROPDOWN --}}
            @auth
            <a class="nav-link d-md-none bg-gray @if (Route::is('admin.messages*')) active @endif"
                            href="{{ route('admin.messages.index') }}"><i class="fa-regular fa-bell"></i></a>
            @endauth
             {{-- UTENTI NON AUTENTICATI --}}
            @guest
             {{-- ACCEDI --}}
             
                 <a class="btn bg-hover text-white" href="{{ route('welcome') }}">{{ __('Accedi') }}</a>
             
             {{-- CONTROLLO DELLA ROTTA REGISTRATI --}}
             @if (Route::has('register'))
                 
                     <a class="btn c-main btn-sec" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                 
             @endif
            @endguest
            @auth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            
                <li class="nav-item mx-2">
                    {{-- PANNELLO DI CONTROLLO --}}
                    <a class="nav-link"
                        href="{{ url('http://localhost:5174/') }}">{{ __('Home') }}</a>
                </li>

                {{-- SOLO UTENTI AUTENTICATI --}}
                    <li class="nav-item mx-2">
                        {{-- PANNELLO DI CONTROLLO --}}
                        <a class="nav-link @if (Route::is('welcome') || Route::is('admin.statistic*')) active @endif"
                            href="{{ route('welcome') }}">{{ __('Pannello di Controllo') }}</a>
                    </li>
                    <li class="nav-item mx-2">
                        {{-- APPARTAMENTI --}}
                        <a class="nav-link @if (Route::is('admin.apartments*')) active @endif"
                            href="{{ route('admin.apartments.index') }}">{{ __('Appartamenti') }}</a>
                    </li>
                @endauth


            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->



                @auth
                    <li class="nav-item mx-2">
                        {{-- MESSAGGI --}}
                        <a class="nav-link d-sm-none d-md-block @if (Route::is('admin.messages*')) active @endif"
                            href="{{ route('admin.messages.index') }}"><i class="fa-regular fa-bell"></i></a>
                    </li>
                    {{-- DROPDOWN --}}
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-regular fa-circle-user"></i>
                            {{-- NOME UTENTE --}}
                            {{ Auth::user()->name }}
                            <i class="fa-solid fa-chevron-down ms-1"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            {{-- PROFILO --}}
                            <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                            {{-- ESCI --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                {{ __('Esci') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth


            </ul>
        </div>
    </div>
</nav>
