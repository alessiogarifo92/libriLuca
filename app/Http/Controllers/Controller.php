<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
      $books=Book::all();
      // dd($books);

      return view('pages.index', compact('books'));
    }

    public function json()
    {
        $books=Book::all();
        // dd($request->all());
        // on submit redirect to pages.index route
        return response()->json([$books]);
    }


    public function store(Request $request)
    {

      // validazione titolo se gia esistente
      Validator::make($request -> all(), [
      'Titolo' => 'unique:books',
      ]) -> validate();

      $book = new Book();

      $book->Titolo = $request->input('Titolo');
      $book->Autore = $request->input('Autore');
      $book->Serie = $request->input('Serie');
      $book->Numero = $request->input('Numero');
      $book->Editore = $request->input('Editore');
      $book->Lingua = $request->input('Lingua');
      $book->ISBN = $request->input('ISBN');
      $book->Prezzo = $request->input('Prezzo');
      $book->MeseAnnoPubblicazione = $request->input('MeseAnnoPubblicazione');
      $book->Letto = $request->input('Letto');
      $book->DataLettura = $request->input('DataLettura');
      $book->Venduto = $request->input('Venduto');
      $book->PrezzoVendita = $request->input('PrezzoVendita');

      if ($request->hasfile('Copertina')) {
        $file = $request->file('Copertina');
        $extension= $file->getClientOriginalExtension();
        $filename = time(). '.' . $extension;
        // adesso creiamo in public cartella uploads/bbok per andare a salvare i file caricati
        $file->move('uploads/book/',$filename);
        // $book viene preso da nome cartella dopo uploads riga sopra
        $book->Copertina = $filename;
      } else {
        return $request;
        $book->Copertina = '';
      }

      $book-> save();

      return redirect()->route('all');

        // Book::create($request->all());
        // // dd($request->all());
        // // on submit redirect to pages.index route
        // return redirect()->route('all');
    }

    public function edit($id) {

     $book = Book::findOrFail($id);
     return view('pages.book-edit',compact('book'));

    }

    public function update(Request $request, $id) {

      $book = Book::findOrFail($id);
      // elimino copertina vecchia
     //  try {
     //
     //   $fileName = $book->Copertina;
     //   $file = public_path('uploads/book/' . $fileName);
     //   File::delete($file);
     //
     // } catch (\Exception $e) {}
     //  // fare $request->file perche se passiamo $book->Copertina è una stringa e poi dara errore in getClientOriginalExtension()
     //  $file = $request->file('Copertina');
     //
     //  $extension= $file->getClientOriginalExtension();
     //  $filename = time(). '.' . $extension;
     //
     //  $file->move('uploads/book/',$filename);
     //
     //  $book->Copertina = $filename;
      $book -> update($request -> all());
      return redirect() -> route('all');

    }

    public function delete($id){
     $book = Book::find($id);

    // elimino da cartella progetto file immagine
     try {

      $fileName = $book->Copertina;
      // controllare i path in filesystem.php
      // uso public_path e non storage perche cartella creata direttamente in public quindi path absolute sara : "C:\Laravel\libriLuca\public\  a cui aggiungo  uploads/book/1619700382.webp"
      $file = public_path('uploads/book/' . $fileName);
      // dd($file);
      // aggiungo in alto use Illuminate\Support\Facades\File;
      File::delete($file);

    } catch (\Exception $e) {}

    // elimino tutto da database
     $book->delete();

    return redirect() -> route('all');
 }
}
