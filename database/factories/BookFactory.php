<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
      'Copertina'=> $faker->randomElement($array = array("ducks.jpg","duck.webp")),
      'Titolo' => $faker -> word,
      'Autore' => $faker -> word,
      'Serie' => $faker -> word,
      'Numero' => $faker -> randomDigit,
      'Editore' => $faker -> word,
      'Lingua' => $faker -> word,
      'ISBN' => $faker -> isbn13,
      'Prezzo' => $faker -> randomDigit,
      'MeseAnnoPubblicazione' => $faker -> date($format = 'm-Y', $max = 'now'),
      'Letto' => $faker -> boolean,
      'DataLettura' => $faker -> date($format = 'd-m-Y', $max = 'now'),
      'Venduto' => $faker -> boolean,
      'PrezzoVendita' => $faker -> randomDigit,
    ];
});
