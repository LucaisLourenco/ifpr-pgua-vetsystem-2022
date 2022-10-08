<?php

namespace App\Http\Controllers;

use App\Models\Peso;
use App\Models\Pet;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'peso' => 'required|max:6|min:4'  
];

$GLOBALS['mensagem']= [
    "peso.required" => "O preenchimento do campo Peso é obrigatório!",
    "peso.max" => "O campo Peso possui tamanho máxixo de 6 caracteres!",
    "peso.min" => "O campo Peso possui tamanho mínimo de 4 caracteres!"
];

class PesoController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function newPeso($pet)
    {
        return view('pesos.newPeso', compact(['pet']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $pet = Pet::find($request->pet_id);

        $peso = new Peso();
        $peso->peso = mb_strtoupper($request->peso);
        $peso->pet()->associate($pet);
        $peso->save();

        return redirect()->route('pets.show', $pet->id);
    }

    public function show(Peso $peso)
    {
        //
    }

    public function edit(Peso $peso)
    {
        //
    }

    public function update(Request $request, Peso $peso)
    {
        //
    }

    public function destroy(Peso $peso)
    {
        //
    }
}
