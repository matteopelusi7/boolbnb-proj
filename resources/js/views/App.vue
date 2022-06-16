<template>
    <div>
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container py-2">
            <a class="navbar-brand" href="/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Airbnb_Logo_B%C3%A9lo.svg/512px-Airbnb_Logo_B%C3%A9lo.svg.png" height="40px" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <input  class="form-control  font-size  col-4   text-center  rounded-pill  mr-sm-2  pl-5 d-none d-md-block"  
                    type="search"  placeholder="Cerca Appartamenti..."  aria-label="Search" v-model="searchbarFilter"/>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav align-items-end ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item btn-nav-register my-2 mx-md-1 px-2 p-md-1 bg-it">
                        <a class="nav-link text-center font-weight-bold text-white" href="/login">Accedi
                        </a>
                    </li>
                    <li class="nav-item btn-nav-register my-2 mx-md-1 px-2 p-md-1 bg-it">
                        <a class="nav-link text-center font-weight-bold text-white" href="/register">Iscriviti</a>
                    </li>
                </ul>
                 <a id="navbarDropdown" class="nav-link dropdown-toggle nav-link text-center font-weight-bold text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   
                                </a>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <router-view>

        </router-view>
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
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>

.bg-color {
    background-color: #f7f7f7;
}

footer ul {
    list-style: none;
    padding: 0;
    gap: 15px;
}

footer a {
    text-decoration: none;
    color: currentColor;
}

footer li {
    line-height: 40px;
}

footer ul li:first-child {
    font-weight: 700;
}

footer .row-line::after {
    content: '';
    display: block;
    background-color: lightgray;
    width: 100%;
    height: 1px;
}

footer a:hover {
    color: currentColor;
}

.list-item {
    gap: 20px;
}

.it {
    font-weight: 600;
}

.btn-nav-register {
    background-color: rgba(255, 255, 255, 0.2);
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
    border-radius: 70% 30% 76% 24% / 44% 73% 27% 56%;
}

.btn-nav-register:hover {
    background-color: #fc1b45;
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.3);
}

.btn-nav-menu {
    background-color: #ffd47c;
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
    border-radius: 27% 43% 38% 19% / 34% 57% 21% 78%;

    .btn-nav-item:hover {
        background-color: rgba(255, 255, 255, 0.4);
    }
}

.btn-nav-searchGv {
    color: black;
    background-color: transparent;
    border: none;
    position: absolute;
    left: 20px;
    z-index: 1;
}

.btn-nav-searchGv:focus-visible {
    outline: none;
    box-shadow: 0px 0px 10px black;
}

.bg-it {
    background-color: #ff385c;
}

</style>