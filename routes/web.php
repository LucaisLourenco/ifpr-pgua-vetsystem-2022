<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteEnderecoController;
use App\Http\Controllers\ClienteTelefoneController;

Route::resource('parametros', 'ParametroController')->middleware(['auth','verified']);

Route::resource('generos', 'GeneroController')->middleware(['auth','verified']);

Route::resource('especies', 'EspecieController')->middleware(['auth','verified']);

Route::resource('racas', 'RacaController')->middleware(['auth','verified']);

Route::resource('clientes', 'ClienteController')->middleware(['auth','verified']);

Route::resource('clienteEnderecos', 'ClienteEnderecoController')->middleware(['auth','verified'])
    ->middleware(['auth','verified']);

Route::get('/newEnderecoCliente/{cliente}', [ClienteEnderecoController::class, 'newEndereco'])
    ->name('clienteEnderecos.newEndereco')->middleware(['auth','verified']);

Route::resource('clienteTelefones', 'ClienteTelefoneController')->middleware(['auth','verified'])
    ->middleware(['auth','verified']);

Route::get('/newTelefoneCliente/{cliente}', [ClienteTelefoneController::class, 'newTelefone'])
    ->name('clienteTelefones.newTelefone')->middleware(['auth','verified']);

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
