<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container py-2">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Airbnb_Logo_B%C3%A9lo.svg/512px-Airbnb_Logo_B%C3%A9lo.svg.png" height="40px" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav align-items-end ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item btn-nav-register my-2 mx-md-1 px-2 p-md-1 bg-it">
                                <a class="nav-link text-center font-weight-bold text-white" href="{{ route('login') }}">Accedi
                                </a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item btn-nav-register my-2 mx-md-1 px-2 p-md-1 bg-it">
                                <a class="nav-link text-center font-weight-bold text-white" href="{{ route('register') }}">Iscriviti</a>
                            </li>
                            @endif
                        @else
                            <li class="nav-item dropdown nav-item btn-nav-register my-2 mx-md-1 px-2 p-md-1 bg-it">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle nav-link text-center font-weight-bold text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Esci
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>

        <footer class="bg-color">
            <div class="container py-4">
                <div class="row row-line py-4">
                    <div class="col-12 col-sm-6 col-md-3">
                        <ul>
                            <li>
                                <a href="#">Assistenza</a>
                            </li>
                            <li>
                                <a href="#">Centro Assistenza</a>
                            </li>
                            <li>
                                <a href="#">AirCover</a>
                            </li>
                            <li>
                                <a href="#">Informazioni di sicurezza</a>
                            </li>
                            <li>
                                <a href="#">Accessibilità per tutti</a>
                            </li>
                            <li>
                                <a href="#">Opzioni di cancellazione</a>
                            </li>
                            <li>
                                <a href="#">Segnala problemi nel quartiere</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <ul>
                            <li>
                                <a href="#">Community</a>
                            </li>
                            <li>
                                <a href="#">Boolbnb.org: un rifugio sicuro</a>
                            </li>
                            <li>
                                <a href="#">Supporta i rifugiati afghani</a>
                            </li>
                            <li>
                                <a href="#">Contro la discriminazione</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <ul>
                            <li>
                                <a href="#">Ospitare</a>
                            </li>
                            <li>
                                <a href="#">Prova a ospitare</a>
                            </li>
                            <li>
                                <a href="#">BoolCover per gli ospiti</a>
                            </li>
                            <li>
                                <a href="#">Esplora le risorse per host</a>
                            </li>
                            <li>
                                <a href="#">Vai al forum della community</a>
                            </li>
                            <li>
                                <a href="#">Come ospitare responsabilmente</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <ul>
                            <li>
                                <a href="#">Informazioni</a>
                            </li>
                            <li>
                                <a href="#">Newsroom</a>
                            </li>
                            <li>
                                <a href="#">Scopri le nuove funzionalità</a>
                            </li>
                            <li>
                                <a href="#">Lettera dai nostri fondatori</a>
                            </li>
                            <li>
                                <a href="#">Opportunità di lavoro</a>
                            </li>
                            <li>
                                <a href="#">Invstitori</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-between py-2 p-0">
                        <div class="d-flex list-item">
                            <a href="#">© 2022 Airbnb, Inc.</a>
                            <a href="#">Privacy</a>
                            <a href="#">Termini</a>
                            <a href="#">Mappa del sito</a>
                            <a href="#">Dettagli dell' Azienda</a>
                        </div>
                        <div>
                            <div class="d-flex list-item">
                                <a class="it" href="#">Italiano (IT)</a>
                                <a class="it" href="#">€ EUR</a>
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</body>
</html>
