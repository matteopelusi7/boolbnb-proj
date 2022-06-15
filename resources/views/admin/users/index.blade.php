@extends('layouts.app')

@section('content')

<div class="container">
    <div class="justify-content-center">

        <h2 class="text-center mb-3">Informazioni personali:</h2>

        <div class="mt-5">
            <p>Nome: {{ $user->name }}</p>
            <p>Cognome: {{ $user->surname }}</p>
            <p>Data di nascita: {{ $user->date_of_birth }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Data di iscrizione: {{ $user->created_at }}</p>
        </div>

        <div>
            <button>
                <a href="{{ route('admin.apartments.index') }}">Vedi i tuoi appartamenti</a>
            </button>
        </div>
        
    </div>
</div>

@endsection