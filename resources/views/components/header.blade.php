<header>
  <div class="left-head">
    <a href="{{route('all')}}">
      <h2>Luca's Book</h2>
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/81/Book_SVG.svg/1280px-Book_SVG.svg.png" alt="">
    </a>
  </div>

  <div v-if="formActive === false && '{{Request::url()}}' == 'http://localhost:8000'" class="form-group has-search">
    <span class="fa fa-search form-control-feedback"></span>
    <input type="text" class="form-control" placeholder="Search" v-model="searchValue">
    <span v-if="searchValue !== ''" id="reset-search" @click="clearSearch">X</span>
  </div>
  {{-- {{ Request::segment(1) }} ottieni primo elemento dopo http://localhost:8000--}}
  {{-- {{Request::route()->getName()}} !== 'book-edit' ottieni nome route--}}
  {{-- {{Request::url()}} ottieni url attuale --}}
  {{-- richiedo url attuale (dentro virgolette e parentesi senno da errore), e lo comparo con url 'http://localhost:8000' (sempre tra virgolette) --}}
  <div v-if="'{{Request::url()}}' == 'http://localhost:8000'" class="right-head">
    <button type="button" name="button" @click="addData()">
      <span v-if="formActive">Close form</span>
      <span v-else>Add new book +</span>
    </button>
  </div>

</header>
