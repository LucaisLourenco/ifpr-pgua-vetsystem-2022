<?php

use Illuminate\Support\Facades\Route;

Route::resource('parametros', 'ParametroController');
Route::resource('generos', 'GeneroController');
Route::resource('especies', 'EspecieController');
Route::resource('racas', 'RacaController');

Route::get('/', function () {
    return view('templates.main')->with('titulo');
})->middleware(['auth'])->name('index');

require __DIR__.'/auth.php';
