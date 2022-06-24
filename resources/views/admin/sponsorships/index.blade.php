@extends('layouts.app')


@section('content')

<div class="container">
    {{-- pulsante create  --}}
    <div>
        <a class="btn btn-primary" href="{{route('admin.dashboard.index')}}">Torna alla dashboard</a>
        <a class="btn btn-primary" href="{{route('admin.apartments.index')}}">Torna agli appartmenti</a>
    </div>

    <div class="container">
        <div class="row row-title d-flex justify-content-center mt-5">
            <h3 class="text-black">Sponsorizza il tuo appartamento</h3>
        </div>
    
        <div class="row row-box-ticket">
            @foreach($sponsorship as $sponsor)

                <div class="box-ticket col-12 col-md-6 col-lg-4 py-3">
                    <div class="ticket-header d-flex justify-content-center flex-wrap">
                        <h3>{{ $sponsor->name }}</h3>
                    </div>
                    <div class="ticket-main">
                        <h4 class="pt-4">{{ $sponsor->price }} &euro;</h4>
                        <h4 class="py-4">{{ $sponsor->duration }} H.</h4>
                    </div>
                    <div class="ticket-footer py-3">
                        <a href="#" class="py-3">Sponsorizza!</a>
                    </div>
                    <span class="featured">Featured!</span>
                </div>

            @endforeach
        </div>

    </div>

    
</div>

@endsection