@extends('layouts.app')


@section('content')

<div class="container">
    {{-- pulsante create  --}}
    <div>
        <a class="btn btn-primary" href="{{route('admin.apartments.create')}}">Aggiungi appartamento</a>
        <a class="btn btn-primary" href="{{route('admin.dashboard.index')}}">Torna alla dashboard</a>
    </div>

    {{-- tabella appartmenti  --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titolo</th>
                <th scope="col">Immagine</th>
                <th scope="col">Numero stanze</th>
                <th scope="col">Numero letti</th>
                <th scope="col">Numero Bagni</th>
                <th scope="col">Metri quadri</th>
                <th scope="col">Servizi Aggiuntivi</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Visibilità</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            {{-- @dump($apartments->adds) --}}
            @foreach($apartments as $apartment)
                <tr>
                    <td>{{ $apartment->title }}</td>
                    <td>
                        @if ($apartment->cover)
                            <img style="width:100px; height:80px" src="{{asset($apartment->cover)}}" alt="">
                        @else 
                            <img style="width:100px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiyxFMYu0x-npJwaXaDUB6gi8DePtyLRxx-w&usqp=CAU" alt="">
                        @endif
                    </td>
                    <td>{{ $apartment->number_of_room }}</td>
                    <td>{{ $apartment->number_of_bedroom }}</td>
                    <td>{{ $apartment->number_of_bathroom }}</td>
                    <td>{{ $apartment->sqm }}</td>
                    <td>
                        @foreach($apartment->adds as $add)
                            <p>{{ $add->name }}</p>
                        @endforeach
                    </td>
                    <td>{{ $apartment->address }}</td>
                    @if ($apartment->visible == 0)
                        <td>
                            <span class="rounded-pill bg-warning p-2 text-nowrap d-flex">Non Visibile</span>
                        </td>
                    @else
                        <td>
                            <span class=" rounded-pill bg-success p-2 text-nowrap">Visibile</span>
                        </td>
                    @endif
                    <td>
                        <a class="btn btn-small btn-secondary" href="{{route('admin.apartments.edit',$apartment)}}">Modifica</a>
                    </td>
                    <td>
                        <form action="{{route('admin.apartments.destroy', $apartment)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small w-100 btn-danger" onclick="return confirm('Sei sicuro di voler rimuovere questo appartamento definitivamente?')">Cancella</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection