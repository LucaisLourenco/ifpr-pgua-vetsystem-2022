<?php

namespace App\Http\Controllers;

use App\Models\ClienteEndereco;
use Illuminate\Http\Request;

class ClienteEnderecoController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
 
    public function show(ClienteEndereco $clienteEndereco)
    {
        //
    }
 
    public function edit(ClienteEndereco $clienteEndereco)
    {
        //
    }
 
    public function update(Request $request, ClienteEndereco $clienteEndereco)
    {
        try
        {
            $enderecoCliente->update([
                "nome" => mb_strtoupper($request->nome_endereco),
                "cep" => $request->cep,
                "rua" => $request->rua,
                "numero" => $request->numero,
                "complemento" => $request->complemento,
                "bairro" => $request->bairro,
                "cidade" => $request->cidade,
                "uf" => mb_strtoupper($request->uf)
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->to('clientes/'.$enderecoCliente->cliente_id);
    }
 
    public function destroy(ClienteEndereco $clienteEndereco)
    {
        //
    }
}
