<?php

use Illuminate\Support\Facades\Route;

Route::resource('parametros', 'ParametroController')->middleware(['auth','verified']);
Route::resource('generos', 'GeneroController')->middleware(['auth','verified']);
Route::resource('especies', 'EspecieController')->middleware(['auth','verified']);
Route::resource('racas', 'RacaController')->middleware(['auth','verified']);
Route::resource('enderecos', 'EnderecoController')->middleware(['auth','verified']);
Route::resource('clientes', 'ClienteController')->middleware(['auth','verified']);
Route::resource('clienteEnderecos', 'ClienteEnderecoController')->middleware(['auth','verified']);


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
})->middleware(['auth:veterinario', 'veterinario.verified'])->name('veterinario');

require __DIR__.'/veterinario.php';
