
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data(){
      return{
        popupActive:true,
        formActive:false,
        books:'',
        searchValue: '',
        filtrati:''
      }
    },
    // mounted con fetch json
    mounted(){

      fetch('http://localhost:8000/json')
      .then(response => response.json())
      .then(json => {
        this.books = json[0];
        // console.log(json[0])
        // console.log(this.books);
      });
    },
    methods:{

      addData(){
        this.formActive = !this.formActive;
        // console.log(this.formActive);
      },
      clearSearch(){
        this.searchValue = '';
      },
      popupToggle(){
        this.popupActive = !this.popupActive;
      }

    },
    computed:{
      // filtro istantaneo in base alla ricerca effettuata
      filteredBooks() {

        // Process search input
        if(this.searchValue !== '' && this.searchValue){
       return this.books.filter((item)=>{
         return this.searchValue.toLowerCase().split(' ').every(v => item.Titolo.toLowerCase().includes(v))
       })
       }else{
         return this.books;
       }
       // this.searchValue = '';
     }
  }
});
