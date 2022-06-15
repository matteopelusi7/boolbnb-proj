@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{route('admin.apartments.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    
        {{-- titolo --}}
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input required type="text" class="form-control @error('title') is-invalid @enderror" value=" {{old('title')}} " name="title" id="title">
            @error('title')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
            </div>
    
            {{-- numero stanze --}}
            <div class="mb-3">
            <label for="number_of_room" class="form-label">Numero di stanze</label>
            <textarea class="form-control @error('number_of_room') is-invalid @enderror" name="number_of_room" id="number_of_room" rows="3"> {{old('number_of_room')}} </textarea>
            @error('number_of_room')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
            </div>
    
            {{-- numero letti --}}
            <div class="mb-3">
            <label for="number_of_bedroom" class="form-label">Numero di letti</label>
            <textarea required class="form-control @error('number_of_bedroom') is-invalid @enderror" name="number_of_bedroom" id="number_of_bedroom" rows="3"> {{old('number_of_bedroom')}} </textarea>
            @error('number_of_bedroom')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
            </div>
    
            {{-- numero bagni --}}
            <div class="mb-3">
            <label for="number_of_bathroom" class="form-label">Numero di bagni</label>
            <input required class="form-control @error('number_of_bathroom') is-invalid @enderror" value="{{old('number_of_bathroom')}}" name="number_of_bathroom" id="number_of_bathroom">
            @error('number_of_bathroom')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
            </div>
    
            {{-- metri quadri --}}
            <div class="mb-3">
                <label for="sqm" class="form-label">Metri quadri</label>
                <input required class="form-control @error('sqm') is-invalid @enderror" value="{{old('sqm')}}" name="sqm" id="sqm">
                @error('sqm')
                    <div class="invalid-feedback"> {{$message}} </div>
                @enderror
            </div>
    
            {{-- indirizzo --}}
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input required class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" name="address" id="address">
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
                    <option {{ old('1') == '1'? 'selected' : '' }} value="1">Visibile</option>
                    <option {{ old('0') == '0'? 'selected' : '' }} value="0">Non visibile</option>
                </select>
            </div>
            @error('visible')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
    
    
    <button type="submit" class="btn btn-primary">Crea</button>
  </form>

@endsection