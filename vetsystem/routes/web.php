<?php

use Illuminate\Support\Facades\Route;

Route::resource('parametros', 'ParametroController')->middleware(['auth']);
Route::resource('generos', 'GeneroController')->middleware(['auth']);
Route::resource('especies', 'EspecieController')->middleware(['auth']);
Route::resource('racas', 'RacaController')->middleware(['auth']);
Route::resource('enderecos', 'EnderecoController')->middleware(['auth']);

Route::get('/sistema', function () {
    return view('templates.main')->with('titulo');
})->middleware(['auth','verified'])->name('sistema');

require __DIR__.'/auth.php';

Route::get('/cliente', function () {
    return view('templatescliente.main')->with('titulo');
})->middleware(['auth:cliente', 'cliente.verified'])->name('cliente');

require __DIR__.'/cliente.php';

Route::get('/veterinario', function () {
    return view('templatesveterinario.main')->with('titulo');
})->middleware(['auth:veterinario'])->name('veterinario');

require __DIR__.'/veterinario.php';
