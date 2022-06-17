@extends('layouts.app')

@section('content')
@if ($apartment->user_id == $user->id)
    <div class="container">
      <form action="{{route('admin.apartments.update', $apartment->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        {{-- titolo --}}
        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input required type="text" class="form-control @error('title') is-invalid @enderror" value=" {{old('title')?: $apartment->title}} " name="title" id="title">
          @error('title')
              <div class="invalid-feedback"> {{$message}} </div>
          @enderror
        </div>

        {{-- numero stanze --}}
        <div class="mb-3">
          <label for="number_of_room" class="form-label">Numero di stanze</label>
          <input type="text" class="form-control @error('number_of_room') is-invalid @enderror" name="number_of_room" id="number_of_room" rows="3" value="{{old('number_of_room')?: $apartment->number_of_room}}">
          @error('number_of_room')
              <div class="invalid-feedback"> {{$message}} </div>
          @enderror
        </div>

        {{-- numero letti --}}
        <div class="mb-3">
          <label for="number_of_bedroom" class="form-label">Numero di letti</label>
          <input type="text" required class="form-control @error('number_of_bedroom') is-invalid @enderror" name="number_of_bedroom" id="number_of_bedroom" rows="3" value="{{old('number_of_bedroom')?: $apartment->number_of_bedroom}}">
          @error('number_of_bedroom')
              <div class="invalid-feedback"> {{$message}} </div>
          @enderror
        </div>

        {{-- numero bagni --}}
        <div class="mb-3">
          <label for="number_of_bathroom" class="form-label">Numero di bagni</label>
          <input required class="form-control @error('number_of_bathroom') is-invalid @enderror" value="{{old('number_of_bathroom')?: $apartment->number_of_bathroom}}" name="number_of_bathroom" id="number_of_bathroom">
          @error('number_of_bathroom')
              <div class="invalid-feedback"> {{$message}} </div>
          @enderror
        </div>

        {{-- metri quadri --}}
        <div class="mb-3">
            <label for="sqm" class="form-label">Metri quadri</label>
            <input required class="form-control @error('sqm') is-invalid @enderror" value="{{old('sqm')?: $apartment->sqm}}" name="sqm" id="sqm">
            @error('sqm')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
        </div>

        {{-- indirizzo --}}
        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input required class="form-control @error('address') is-invalid @enderror" value="{{old('address')?: $apartment->address}}" name="address" id="address">
            @error('address')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
        </div>

        {{-- cover --}}
        <div class="mb-3">
          <label class="d-block" for="cover">Immagine</label>
          <input class="d-block my-3 @error('cover') is-invalid @enderror" accept=".jpg, .jpeg, .gif, .png, .svg" type="file" name="cover" id="cover">
          @error('cover')
              <div class="invalid-feedback"> {{$message}} </div>
          @enderror
        </div>
        

        {{-- visibile --}}
        <div class="form-group">
          <label for="visible">Visibilità</label>
            <select class="form-control" name="visible" id="visible">
              <option {{ old('1', $apartment->visible) == '1' ? 'selected' : '' }} value="1">Visibile</option>
              <option {{ old('0', $apartment->visible) == '0' ? 'selected' : '' }} value="0">Non visibile</option>
            </select>
        </div>
        @error('visible')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror

        {{-- adds --}}

        <div class="form-group form-check row py-3">
          <label for="adds"
              class="col-form-label text-md-right">Servizi aggiuntivi</label>
          <div class="row m-0 py-2 d-flex flex-column pb-3">
              @foreach ($adds as $add)
              <div class="col-3 m-0">
                  <input type="checkbox" class="form-check-input @error('adds') is-invalid @enderror"
                      value="{{ $add->id }}"
                      {{ is_array(old('adds')) && in_array($add->id, old('adds')) ? ' checked' : '' }}
                      oninvalid="this.setCustomValidity('Inserisci almeno un servizio aggiuntivo')"
                      oninput="this.setCustomValidity('')"
                      name="adds[]" id="add-{{ $add->id }}">
                  <label class="form-check-label" for="adds-{{ $add->id }}">{{ $add->name }}</label>
          </div>
          @endforeach
          @error('adds')
              <span class="text-danger m-0 pt-2" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
          

      </div>
        
        <button class="btn btn-primary d-inline" type="submit">Conferma Modifica</button>
        <a class="btn btn-small border rounded d-inline" type='submit' href="{{ route('admin.apartments.index') }}">Torna alla degli appartamenti</a>

      </form>
    </div>
    @else
        <div class="container text-center">
        <h2 >Non hai i permessi per visualizzare questa pagina!</h2>
        <a class="btn btn-small btn-secondary" href="{{ route('admin.apartments.index') }}">Torna alla dashboard</a>
        </div>  
    @endif
@endsection