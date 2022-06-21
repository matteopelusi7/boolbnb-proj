@extends('layouts.app')


@section('content')

<div class="container">
    {{-- pulsante create  --}}
    <div>
        <a class="btn btn-primary" href="{{route('admin.apartments.index')}}">Torna agli appartmenti</a>
        <a class="btn btn-primary" href="{{route('admin.dashboard.index')}}">Torna alla dashboard</a>
    </div>

    {{-- tabella appartmenti  --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Messaggi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>
                        <div>
                            <p>Messaggio da: {{ $message->email }}</p>
                            <p>Testo Messaggio: {{ $message->text }}</p>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection