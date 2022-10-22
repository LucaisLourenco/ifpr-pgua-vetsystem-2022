<?php

namespace App\Http\Controllers;

use App\Models\Veterinario;
use App\Models\VeterinarioTelefone;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome_telefone' => 'required|min:3|max:30',
    'numero_telefone' => 'required|min:14',
];

$GLOBALS['mensagem']= [
    "nome_telefone.required" => "O preenchimento do campo Nome do Contato é obrigatório!",
    "nome_telefone.max" => "O campo Nome do Contato possui tamanho máxixo de 30 caracteres!",
    "nome_telefone.min" => "O campo Nome do Contato possui tamanho mínimo de 2 caracteres!",
    "numero_telefone.required" => "O preenchimento do campo Contato é obrigatório!",
    "numero_telefone.min" => "O campo Contato possui tamanho mínimo de 10 dígitos!",
];

class VeterinarioTelefoneController extends Controller
{
    public function index()
    {
        //
    }
 
    public function create()
    {
        //
    }

    public function newTelefone($veterinario) {
        return view('veterinarioTelefones.newTelefone', compact(['veterinario']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $veterinario = Veterinario::find($request->veterinario_id);

        $telefone = new VeterinarioTelefone();
        $telefone->nome = mb_strtoupper($request->nome_telefone);
        $telefone->numero = $request->numero_telefone;
        $telefone->veterinario()->associate($veterinario);
        $telefone->save();

        return redirect()->route('veterinarios.show', $veterinario->id);
    }

    public function show(VeterinarioTelefone $veterinarioTelefone)
    {
        //
    }

    public function edit(VeterinarioTelefone $veterinarioTelefone)
    {
        return view('veterinarioTelefones.edit', compact(['veterinarioTelefone']));
    }

    public function update(Request $request, VeterinarioTelefone $veterinarioTelefone)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $veterinarioTelefone->update([
                "nome" => mb_strtoupper($request->nome_telefone),
                "numero" => $request->numero_telefone,
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('veterinarios.show', $veterinarioTelefone->veterinario_id);
    }
 
    public function destroy(VeterinarioTelefone $veterinarioTelefone)
    {
        try
        {
            $veterinarioTelefone->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
           
        } catch(\Exception $exception)
        { 
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('veterinarios.show', $veterinarioTelefone->veterinario_id);
    }
}
