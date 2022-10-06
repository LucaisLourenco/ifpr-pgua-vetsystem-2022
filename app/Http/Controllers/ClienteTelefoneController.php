<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteTelefone;
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

class ClienteTelefoneController extends Controller
{ 
    public function index()
    {
        //
    }
 
    public function create()
    {
        //
    }

    public function newTelefone($cliente) {
        return view('clienteTelefones.newTelefone', compact(['cliente']));
    }
 
    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $cliente = Cliente::find($request->cliente_id);

        $telefone = new ClienteTelefone();
        $telefone->nome = mb_strtoupper($request->nome_telefone);
        $telefone->numero = $request->numero_telefone;
        $telefone->cliente()->associate($cliente);
        $telefone->save();

        return redirect()->route('clientes.show', $cliente->id);
    }
 
    public function show(ClienteTelefone $clienteTelefone)
    {
        //
    }

    public function edit(ClienteTelefone $clienteTelefone)
    {
        return view('clienteTelefones.edit', compact(['clienteTelefone']));
    }
 
    public function update(Request $request, ClienteTelefone $clienteTelefone)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $clienteTelefone->update([
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

        return redirect()->route('clientes.show', $clienteTelefone->cliente_id);
    }
 
    public function destroy(ClienteTelefone $clienteTelefone)
    {
        try
        {
            $clienteTelefone->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
           
        } catch(\Exception $exception)
        { 
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('clientes.show', $clienteTelefone->cliente_id);
    }
}
