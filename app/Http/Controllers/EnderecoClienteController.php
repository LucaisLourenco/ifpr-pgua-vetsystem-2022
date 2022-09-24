<?php

namespace App\Http\Controllers;

use App\Models\EnderecoCliente;
use Illuminate\Http\Request;

class EnderecoClienteController extends Controller
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

    public function show(EnderecoCliente $enderecoCliente)
    {
        //
    }

    public function edit(EnderecoCliente $enderecoCliente)
    {
        return view('endereco-clientes.edit', compact(['enderecoCliente']));
    }

    public function update(Request $request, EnderecoCliente $enderecoCliente)
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

    public function destroy(EnderecoCliente $enderecoCliente)
    {
        //
    }
}
