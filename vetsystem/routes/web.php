<?php

use Illuminate\Support\Facades\Route;

Route::resource('parametros', 'ParametroController');
Route::resource('generos', 'GeneroController');
Route::resource('especies', 'EspecieController');
Route::resource('racas', 'RacaController');
Route::resource('enderecos', 'EnderecoController');

Route::get('/sistema', function () {
    return view('templates.main')->with('titulo');
})->middleware(['auth'])->name('sistema');

require __DIR__.'/auth.php';

Route::get('/cliente', function () {
    return view('templatescliente.main')->with('titulo');
})->middleware(['auth:cliente'])->name('cliente');

require __DIR__.'/cliente.php';

Route::get('/veterinario', function () {
    return view('templatesveterinario.main')->with('titulo');
})->middleware(['auth:veterinario'])->name('veterinario');

require __DIR__.'/veterinario.php';
