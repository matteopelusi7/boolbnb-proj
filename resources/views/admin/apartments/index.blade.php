@extends('layouts.app')

@section('content')

<div class="container">
    <div class="justify-content-center">

        <h2 class="text-center mb-3">I tuoi appartamenti:</h2>

        @foreach ($apartments as $apartment)

            <div class="d-flex mt-5 mb-5">
                <div>
                    <img src="{{asset($apartment->cover)}}" alt="">
                </div>

                @if($apartment->visible == true)
                    <div class="pl-3">
                        <p>Titolo: {{$apartment->title}}</p>
                        <p>Numero di Stanze: {{ $apartment->number_of_room }}</p>
                        <p>Numero di letti: {{ $apartment->number_of_bedroom }}</p>
                        <p>Numero di Bsagni: {{ $apartment->number_of_bathroom }}</p>
                        <p>Metri quadrati: {{ $apartment->sqm }}</p>
                        <p>Indirizzo: {{ $apartment->address }}</p>
                    </div>
                @endif
            </div>
            
            @endforeach
            
            <a class="btn btn-primary" href="{{route('admin.apartments.create')}}">Aggiungi appartamento</a>
            <a class="btn btn-primary" href="{{route('admin.dashboard.index')}}">Torna alla dashboard</a>
        
    </div>
</div>

@endsection