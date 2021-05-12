@extends('layouts.main-layout')

@section('edit-form')

  <div id="editing-form">
    <h1>Update '{{$book-> Titolo}}' book data!</h1>

    <form id="edit" action="{{ route('book-update', $book -> id)}}" method="POST" enctype="multipart/form-data">

      @csrf
      @method('POST')

      <div class="">
        {{-- <label for="Copertina">Copertina: </label>
        <input type="file" name="Copertina" value="{{ $book -> Copertina}}"> --}}

        <label for="Titolo">Titolo: </label>
        <input type="text" name="Titolo" value="{{ $book -> Titolo}}">

        <label for="Autore">Autore: </label>
        <input type="text" name="Autore" value="{{ $book -> Autore}}">
      </div>

      <br>

      <div class="">
        <label for="Serie">Serie: </label>
        <input type="text" name="Serie" value="{{ $book -> Serie}}">

        <label for="Numero">Numero: </label>
        <input type="text" name="Numero" value="{{ $book -> Numero}}">
      </div>

      <br>

      <div class="">
        <label for="Editore">Editore: </label>
        <input type="text" name="Editore" value="{{ $book -> Editore}}">

        <label for="Lingua">Lingua: </label>
        <input type="text" name="Lingua" value="{{ $book -> Lingua}}">
      </div>

      <br>

      <div class="">
        <label for="ISBN">ISBN: </label>
        <input type="text" name="ISBN" value="{{ $book -> ISBN}}">

        <label for="Prezzo">Prezzo: </label>
        <input type="text" name="Prezzo" value="{{ $book -> Prezzo}}">
      </div>

      <br>

      <div class="">
        <label for="MeseAnnoPubblicazione">MeseAnnoPubblicazione: </label>
        <input type="text" name="MeseAnnoPubblicazione" value="{{ $book -> MeseAnnoPubblicazione}}">
      </div>

      <br>

      <div class="">
        <label for="Letto">Letto: </label>
        <input type="text" name="Letto" value="{{ $book -> Letto}}">

        <label for="DataLettura">DataLettura: </label>
        <input type="text" name="DataLettura" value="{{ $book -> DataLettura}}">
      </div>

      <br>

      <div class="">
        <label for="Venduto">Venduto: </label>
        <input type="text" name="Venduto" value="{{ $book -> Venduto}}">

        <label for="PrezzoVendita">PrezzoVendita: </label>
        <input type="text" name="PrezzoVendita" value="{{ $book -> PrezzoVendita}}">
      </div>

      <br>

      <div class="">
        <input class="button" type="submit" value="Aggiorna">
      </div>


    </form>
  </div>



@endsection
