<?php

namespace App\Http\Controllers;

use App\Models\Peso;
use App\Models\Pet;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'peso' => 'required|max:7|min:4'  
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
        return view('pesos.edit', compact(['peso']));
    }

    public function update(Request $request, Peso $peso)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $peso->update([
                "peso" => $request->peso,
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('pets.show', $peso->pet_id);
    }

    public function destroy(Peso $peso)
    {
        try
        {
            $peso->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
           
        } catch(\Exception $exception)
        { 
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('pets.show', $peso->pet_id);
    }
}
