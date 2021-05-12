<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Controller@index')->name('all');

Route::get('/json', 'Controller@json')->name('json');

Route::post('/store', 'Controller@store')->name('store');

Route::get('/edit/{id}','Controller@edit')
 ->name('book-edit');

 Route::post('/update/{id}' ,'Controller@update')
  ->name('book-update');


// Route::delete('/json/delete/{id}', 'Controller@delete')->name('delete');
Route::get('/delete/{id}', 'Controller@delete')->name('delete-book');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
