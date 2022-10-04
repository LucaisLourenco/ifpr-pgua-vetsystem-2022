<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pet;
use App\Models\Raca;
use App\Models\Sexo;
use App\Models\Especie;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['cliente','sexo','raca'])->get();

        return view('pets.index', compact(['pets']));
    }

    public function create()
    {
        $especies = Especie::all();
        $sexos = Sexo::all();
        $clientes = Cliente::all();

        return view('Pets.create', compact(['especies','sexos','clientes']));
    }

    public function store(Request $request)
    {
        //$request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $raca = Raca::find($request->raca_id);  
            $cliente = Cliente::find($request->cliente_id);  
            $sexo = Sexo::find($request->sexo_id);  

            $pet = new Pet();
            $pet->nome = mb_strtoupper($request->nome);
            $pet->data_nascimento = $request->data_nascimento;
            $pet->ativo = 1;
            $pet->raca()->associate($raca);
            $pet->cliente()->associate($cliente);
            $pet->sexo()->associate($sexo);
            $pet->save();

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('pets.index');
    }

    public function show(Pet $pet)
    {
        //
    }

    public function edit(Pet $pet)
    {
        //
    }

    public function update(Request $request, Pet $pet)
    {
        //
    }

    public function destroy(Pet $pet)
    {
        //
    }
}
