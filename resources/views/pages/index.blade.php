@extends('layouts.main-layout')

@section('content')
  <div v-if="formActive == false" class="content">

    <h1>Books list</h1>
    @if ($errors->any())
      <div v-if="popupActive" class="allScreen">
        <div :class="{popup : popupActive}">
          <button @click="popupToggle()" type="button" name="button"></button>
            <h3>Errors:</h3>
            <ul>
              <li><strong>Titolo gia presente in archivio</strong></li>
            </ul>
        </div>
      </div>

    @endif
    <table class="table table-bordered table-striped table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col" style="min-width: 160px;">Copertina</th>
          <th scope="col" style="min-width: 160px;">Titolo</th>
          <th scope="col" style="min-width: 160px;">Autore/i</th>
          <th scope="col" style="min-width: 160px;">Serie</th>
          <th scope="col" style="min-width: 50px;">Numero</th>
          <th scope="col" style="min-width: 100px;">Editore</th>
          <th scope="col" style="min-width: 100px;">Lingua</th>
          <th scope="col" style="min-width: 160px;">ISBN, EAN</th>
          <th scope="col" style="min-width: 50px;">Prezzo(€)</th>
          <th scope="col" style="min-width: 100px;">Mese/Anno pubblicazione</th>
          <th scope="col" style="min-width: 50px;">Letto?</th>
          <th scope="col" style="min-width: 100px;">Data lettura</th>
          <th scope="col" style="min-width: 50px;">Venduto?</th>
          <th scope="col" style="min-width: 50px;">Prezzo Vendita (€)</th>
        </tr>
      </thead>
      <tbody>
        {{-- utilizzo computed function come array per filtrare sul momento --}}
        <tr v-for="(book,index) in filteredBooks" :key="book.id">
          {{-- ricordarsi @ senno non funziona --}}
          <th class="bookid" scope="row">@{{index + 1}}</th>
          <td style="min-width: 160px;display: flex;justify-content: center;align-items: center;">
            {{-- path da public per accedere ad immagine --}}
            <img :src="'/uploads/book/' + book.Copertina" alt="">
          </td>
          <td style="min-width: 160px;">@{{book.Titolo}}</td>
          <td>@{{book.Autore}}</td>
          <td>@{{book.Serie}}</td>
          <td>@{{book.Numero}}</td>
          <td>@{{book.Editore}}</td>
          <td>@{{book.Lingua}}</td>
          <td>@{{book.ISBN}}</td>
          <td>@{{book.Prezzo}}</td>
          <td>@{{book.MeseAnnoPubblicazione}}</td>
          <td>@{{book.Letto == 0 ? 'si' : 'no'}}</td>
          <td>@{{book.DataLettura}}</td>
          <td>@{{book.Venduto == 0 ? 'si' : 'no'}}</td>
          <td>@{{book.PrezzoVendita}}</td>

          <td style="min-width: 100px;">
            {{--non usare href="{{ route('edit-book', $book -> id )}}" ma scrivere come sotto tutta la rotta--}}
            <a id="edit" :href="'/edit/' + book.id" title="edit book">
              <span>
                <i class="far fa-edit"></i>
              </span>
            </a>


            <a id="delete" :href="'/delete/' + book.id" title="delete book">
              <span>
                <i class="far fa-trash-alt"></i>
              </span>
            </a>

          </td>

        </tr>
      </tbody>

      {{-- versione php --}}
      <tbody style="display:none;">
        @foreach ($books as $key=>$book)
          <tr>
            <th class="bookid" scope="row">{{$key + 1}}</th>
            <td style="min-width: 160px;display: flex;justify-content: center;align-items: center;">
              {{-- path da public per accedere ad immagine --}}
              <img src="/uploads/book/{{$book -> Copertina}}" alt="">
            </td>
            <td style="min-width: 160px;">{{$book -> Titolo}}</td>
            <td>{{$book -> Autore}}</td>
            <td>{{$book -> Serie}}</td>
            <td>{{$book -> Numero}}</td>
            <td>{{$book -> Editore}}</td>
            <td>{{$book -> Lingua}}</td>
            <td>{{$book -> ISBN}}</td>
            <td>{{$book -> Prezzo}}</td>
            <td>{{$book -> MeseAnnoPubblicazione}}</td>
            <td>{{$book -> Letto == 0 ? 'si' : 'no'}}</td>
            <td>{{$book -> DataLettura}}</td>
            <td>{{$book -> Venduto == 0 ? 'si' : 'no'}}</td>
            <td>{{$book -> PrezzoVendita}}</td>

            {{-- <button type="button" name="button" @click="deleteEvent({{$book->id}})">delete</button> --}}
            <td style="min-width: 100px;">

              <a id="edit" href="{{ route('book-edit', $book -> id )}}" title="edit book">
                <span>
                  <i class="far fa-edit"></i>
                </span>
              </a>


              <a id="delete" href="{{ route('delete-book', $book -> id )}}" title="delete book">
                <span>
                  <i class="far fa-trash-alt"></i>
                </span>
              </a>


              {{-- <button  type="button" name="button" @click="deleteData({{$book->id}})">delete</button> --}}
            </td>

          </tr>
        @endforeach

      </tbody>
    </table>
  </div>
{{-- v-else --}}
  <div v-else class="content">

    <form id="store-form" action="{{route('store')}}" method="POST" enctype="multipart/form-data">
      {{-- quando si usa input file per passare immagini ricordarsi  enctype="multipart/form-data" --}}
      @method('POST')
      @csrf
      <div class="">
        <label for="Copertina">Copertina</label>
        <input type="file" name="Copertina" id="copertina" required onchange="readURL(this);"/>
        <img id="blah" src="" alt="copertina" />
      </div>

      <div class="">
        <label for="Titolo">Titolo</label>

        {{-- non avendo usato 2 rotte per create e store, handle error con required --}}
        <input type="text" name="Titolo" required>

        <label for="Autore">Autore/i</label>
        <input type="text" name="Autore">
      </div>

      <div class="">
        <label for="Serie">Serie</label>
        <input type="text" name="Serie">

        <label for="Numero">Numero</label>
        <input type="text" name="Numero">
      </div>

      <div class="">
        <label for="Editore">Editore</label>
        <input type="text" name="Editore">

        <label for="ISBN">ISBN,EAN</label>
        <input type="text" name="ISBN" pattern="[0-9]{10,13}" title="deve avere tra 10 e 13 numeri">
      </div>

      <div class="">
        <label for="Prezzo">Prezzo</label>
        <span>€</span>
        {{-- pattern per prezzo validation --}}
        <input type="text" name="Prezzo" pattern="\d+(\.\d{1,2})?" title="non usare la ',' ma il punto '.'">

        <label for="DataLettura">Data lettura</label>
        <input type="text" name="DataLettura"pattern="(?:(?:0[1-9]|1[0-2])-(?:19|20)[0-9]{2}" placeholder="mm-yyyy" title="date format required mm-yyyy">

        <label for="PrezzoVendita">Prezzo Vendita</label>
        <span>€</span>
        <input type="text" name="PrezzoVendita" pattern="\d+(\.\d{1,2})?" title="non usare la ',' ma il punto '.'">
      </div>

      <div class="">
        <label for="MeseAnnoPubblicazione">Mese/Anno pubblicazione</label>
        <input type="text" name="MeseAnnoPubblicazione" placeholder="mm-yyyy" pattern="(?:(?:0[1-9]|1[0-2])-(?:19|20)[0-9]{2}" title="date format required mm-yyyy">
      </div>

      <div class="">
        <label for="Lingua">Lingua</label>
        <select class="" name="Lingua">
          <option value="---" selected>---</option>
          <option value="Italiano">Italiano</option>
          <option value="Inglese">Inglese</option>
          <option value="Spagnolo">Spagnolo</option>
          <option value="Portoghese">Portoghese</option>
          <option value="Tedesco">Tedesco</option>
          <option value="Cinese">Cinese</option>
          <option value="Altro">Altro</option>
        </select>

        <label for="Letto">Letto?</label>
        <select class="" name="Letto">
          <option value="" selected></option>
          <option value="0">si</option>
          <option value="1">no</option>
        </select>

        <label for="Venduto">Venduto?</label>
        <select class="" name="Venduto">
          <option value="" selected></option>
          <option value="0">si</option>
          <option value="1">no</option>
        </select>
      </div>

      <div class="">
        <button type="submit" name="button">Submit</button>
      </div>


    </form>
  </div>


@endsection
{{-- script per visualizzare immagine dopo averla aggiunta in input file --}}
<script type="text/javascript">
function readURL(input) {
     if (input.files && input.files[0]) {
         var reader = new FileReader();

         reader.onload = function (e) {
             $('#blah')
                 .attr('src', e.target.result)
                 .width(80)
                 .height(100);
         };

         reader.readAsDataURL(input.files[0]);
     }
 }

</script>
