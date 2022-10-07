<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pet;
use App\Models\Raca;
use App\Models\Sexo;
use App\Models\Especie;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome' => 'required|max:100|min:2',
    'especie_id' => 'required',
    'cliente_id' => 'required',
    'raca_id' => 'required',
    'sexo_id' => 'required',
    'data_nascimento' => 'required',
];

$GLOBALS['mensagem']= [
    "name.required" => "O preenchimento do campo NOME é obrigatório!",
    "name.max" => "O campo NOME possui tamanho máxixo de 100 caracteres!",
    "name.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
    "especie_id.required" => "A seleção do campo Espécie é obrigatório!",
    "cliente_id.required" => "A seleção do campo Cliente é obrigatório!",
    "raca_id.required" => "A seleção do campo Raça é obrigatório!",
    "sexo_id.required" => "A seleção do campo Sexo é obrigatório!",
    "data_nascimento.required" => "O preenchimento do campo Data de Nascimento é obrigatório!"
];

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
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

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
        return view('pets.show', compact(['pet']));
    }

    public function edit(Pet $pet)
    {
        $especie = $pet->raca->especie;

        $especies = Especie::all();
        if(!array_exists_in_array($especies, $especie)) {
            $especies->push($especie);
        }
        
        $sexos = Sexo::all();
        if(!array_exists_in_array($sexos, $pet->sexo)) {
            $sexos->push($pet->sexo);
        }

        $clientes = Cliente::all();
        if(!array_exists_in_array($clientes, $pet->cliente)) {
            $clientes->push($pet->cliente);
        }

        return view('pets.edit', compact(['pet','especie','especies','sexos','clientes']));
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $pet->update([
                "nome" => mb_strtoupper($request->nome),
                'data_nascimento' => $request->data_nascimento,
                'raca_id' => $request->raca_id,
                'cliente_id' => $request->cliente_id,
                'sexo_id' => $request->sexo_id
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('pets.show', $pet->id);
    }

    public function destroy(Pet $pet)
    {
        try
        {
            $pet->delete();

            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
            
        } catch(\Exception $exception)
        { 
           session()->flash('mensagem', $exception->getMessage());
           session()->flash('resultado', null);
        }

        return redirect()->route('pets.index');
    }

    public function createViewCliente($cliente) {

        $especies = Especie::all();
        $sexos = Sexo::all();

        return view('Pets.createViewCliente', compact(['cliente', 'sexos', 'especies']));
    }

    public function storeViewCliente(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

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

        return redirect()->route('clientes.show', $cliente->id);
    }
}
