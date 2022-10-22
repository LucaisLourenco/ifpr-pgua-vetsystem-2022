<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteEnderecoController;
use App\Http\Controllers\ClienteTelefoneController;
use App\Http\Controllers\UserEnderecoController;
use App\Http\Controllers\UserTelefoneController;
use App\Http\Controllers\VeterinarioEnderecoController;
use App\Http\Controllers\VeterinarioTelefoneController;
use App\Http\Controllers\RacaController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PesoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeterinarioController;

Route::group(['middleware' => ['auth','verified'], 'prefix' => 'sistema'], function() {

    Route::resource('parametros', 'ParametroController');

    Route::resource('generos', 'GeneroController');

    Route::resource('especies', 'EspecieController');

    Route::resource('sexos', 'SexoController');

    Route::resource('racas', 'RacaController');

    Route::resource('clientes', 'ClienteController');

    Route::resource('pesos', 'PesoController');

    Route::get('/newPeso/{pet}', [PesoController::class, 'newPeso'])
        ->name('pesos.newPeso');

    //Veterinário endereços e telefones
    Route::resource('veterinarioEnderecos', 'VeterinarioEnderecoController');

    Route::resource('veterinarioTelefones', 'VeterinarioTelefoneController');

    Route::get('/newEnderecoVeterinario/{veterinario}', [VeterinarioEnderecoController::class, 'newEndereco'])
        ->name('veterinarioEnderecos.newEndereco');

    Route::get('/newTelefoneVeterinario/{veterinario}', [VeterinarioTelefoneController::class, 'newTelefone'])
        ->name('veterinarioTelefones.newTelefone');

    //Funcionário endereços e telefones
    Route::resource('userEnderecos', 'UserEnderecoController');

    Route::resource('userTelefones', 'UserTelefoneController');

    Route::get('/newEnderecoUser/{user}', [UserEnderecoController::class, 'newEndereco'])
        ->name('userEnderecos.newEndereco');

    Route::get('/newTelefoneUser/{user}', [UserTelefoneController::class, 'newTelefone'])
        ->name('userTelefones.newTelefone');

    //Cliente endereços e telefones
    Route::resource('clienteEnderecos', 'ClienteEnderecoController');

    Route::resource('clienteTelefones', 'ClienteTelefoneController');
    
    Route::get('/newEnderecoCliente/{cliente}', [ClienteEnderecoController::class, 'newEndereco'])
        ->name('clienteEnderecos.newEndereco');

    Route::get('/newTelefoneCliente/{cliente}', [ClienteTelefoneController::class, 'newTelefone'])
        ->name('clienteTelefones.newTelefone');

    Route::get('/createViewCliente/{cliente}', [PetController::class, 'createViewCliente'])
        ->name('pets.createViewCliente');

    Route::post('createViewCliente', [PetController::class, 'storeViewCliente'])
        ->name('pets.storeViewCliente');

    //Redefinir senha cliente
    Route::get('/redefinirSenhaCliente/{cliente}', [ClienteController::class, 'redefinirSenha'])
        ->name('clientes.redefinirSenha');

    Route::put('redefinirSenhaCliente/{cliente}', [ClienteController::class, 'newSenha'])
        ->name('clientes.newSenha');

    //Redefinir senha veterinário
    Route::get('/redefinirSenhaVeterinario/{veterinario}', [VeterinarioController::class, 'redefinirSenha'])
    ->name('veterinarios.redefinirSenha');

    Route::put('redefinirSenhaVeterinario/{veterinario}', [VeterinarioController::class, 'newSenha'])
        ->name('veterinarios.newSenha');

    //Redefinir senha veterinário
    Route::get('/redefinirSenhaFuncionario/{user}', [UserController::class, 'redefinirSenha'])
    ->name('users.redefinirSenha');

    Route::put('redefinirSenhaFuncionario/{user}', [UserController::class, 'newSenha'])
        ->name('users.newSenha');

    Route::resource('pets', 'PetController');

    Route::resource('users', 'UserController');

    Route::resource('especialidades', 'EspecialidadeController');

    Route::resource('veterinarios', 'VeterinarioController');
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