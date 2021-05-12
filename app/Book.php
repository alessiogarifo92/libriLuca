<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $fillable = [
    'Copertina',
    'Titolo',
    'Autore',
    'Serie',
    'Numero',
    'Editore',
    'Lingua',
    'ISBN',
    'Prezzo',
    'MeseAnnoPubblicazione',
    'Letto',
    'DataLettura',
    'Venduto',
    'PrezzoVendita',
  ];

}
