<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteEnderecoController;
use App\Http\Controllers\ClienteTelefoneController;
use App\Http\Controllers\RacaController;
use App\Http\Controllers\PetController;


Route::group(['middleware' => ['auth','verified'], 'prefix' => 'sistema'], function() {

    Route::resource('parametros', 'ParametroController');

    Route::resource('generos', 'GeneroController');

    Route::resource('especies', 'EspecieController');

    Route::resource('sexos', 'SexoController');

    Route::resource('racas', 'RacaController');

    Route::resource('clientes', 'ClienteController');

    Route::resource('clienteEnderecos', 'ClienteEnderecoController');

    Route::get('/newEnderecoCliente/{cliente}', [ClienteEnderecoController::class, 'newEndereco'])
        ->name('clienteEnderecos.newEndereco');

    Route::resource('clienteTelefones', 'ClienteTelefoneController');

    Route::get('/newTelefoneCliente/{cliente}', [ClienteTelefoneController::class, 'newTelefone'])
        ->name('clienteTelefones.newTelefone');

    Route::get('/createViewCliente/{cliente}', [PetController::class, 'createViewCliente'])
        ->name('pets.createViewCliente');

    Route::post('createViewCliente', [PetController::class, 'storeViewCliente'])
            ->name('pets.storeViewCliente');

    Route::resource('pets', 'PetController');
});

Route::get('/sistema', function () {
    return view('templates.main')->with('titulo');
})->middleware(['auth','verified'])->name('sistema');

require __DIR__.'/auth.php';

Route::get('/WebCliente', function () {
    return view('templatescliente.main')->with('titulo');
})->middleware(['auth:cliente', 'cliente.verified'])->name('cliente');

require __DIR__.'/cliente.php';

Route::get('/WebVeterinario', function () {
    return view('templatesveterinario.main')->with('titulo');
})->middleware(['auth:veterinario', 'veterinario.verified'])->name('veterinario');

require __DIR__.'/veterinario.php';

//FUNCOES 
Route::post('/selectRaca', 'RacaController@selectRaca');