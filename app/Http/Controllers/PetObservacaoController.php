<?php

namespace App\Http\Controllers;

use App\Facades\UserPermissions;
use App\Models\Pet;
use App\Models\PetObservacao;
use App\Models\Veterinario;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'tipo' => 'required|max:30|min:4'  
];

$GLOBALS['mensagem']= [
    "tipo.required" => "O preenchimento do campo Tipo é obrigatório!",
    "tipo.max" => "O campo Tipo possui tamanho máxixo de 30 caracteres!",
    "tipo.min" => "O campo Tipo possui tamanho mínimo de 4 caracteres!"
];

class PetObservacaoController extends Controller
{
    public function __construct() {
        $this->authorizeResource(PetObservacao::class, 'petobservacao');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function newObservacao($pet)
    {
        if(!UserPermissions::isAuthorized('pets.create')) {
            return abort(redirect()->route('acessonegado.index'));
        }

        $veterinarios = Veterinario::all();

        return view('petobservacaos.newObservacao', compact(['pet', 'veterinarios']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $pet = Pet::find($request->pet_id);
        $veterinario = Veterinario::find($request->veterinario_id);

        $petobservacao = new PetObservacao();
        $petobservacao->tipo = mb_strtoupper($request->tipo);
        $petobservacao->descricao = $request->descricao;
        $petobservacao->pet()->associate($pet);
        $petobservacao->veterinario()->associate($veterinario);
        $petobservacao->save();

        return redirect()->route('pets.show', $pet->id);
    }

    public function show(PetObservacao $petObservacao)
    {
        //
    }

    public function edit(PetObservacao $petobservacao)
    {
        $veterinarios = Veterinario::all();

        if($petobservacao->veterinario){
            if(!array_exists_in_array($veterinarios, $petobservacao->veterinario)) {
                $veterinarios->push($petobservacao->veterinario);
            }
        }

        return view('petobservacaos.edit', compact(['petobservacao','veterinarios']));    
    }

    public function update(Request $request, PetObservacao $petobservacao)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $petobservacao->update([
                'tipo' => mb_strtoupper($request->tipo),
                'descricao' => $request->descricao,
                'veterinario_id' => $request->veterinario_id
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('pets.show', $petobservacao->pet_id);
    }

    public function destroy(PetObservacao $petobservacao)
    {
        try
        {
            $petobservacao->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
           
        } catch(\Exception $exception)
        { 
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('pets.show', $petobservacao->pet_id);
    }
}
