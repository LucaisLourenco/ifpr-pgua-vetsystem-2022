<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('enderecos.create');
    }

    public function store(Request $request)
    {
       //$request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try 
        {
            Endereco::create([
                "nome" => mb_strtoupper($request->nome),
                "cep" => $request->cep,
                "rua" => $request->rua,
                "numero" => $request->numero,
                "complemento" => $request->complemento,
                "bairro" => $request->bairro,
                "uf" => $request->uf,
                "cliente_id" => $request->cliente_id
            ]);

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('enderecos.index');
    }

    public function show(Endereco $endereco)
    {
        //
    }

    public function edit(Endereco $endereco)
    {
        return view('enderecos.edit', compact(['endereco']));
    }

    public function update(Request $request, Endereco $endereco)
    {
        //$request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);
     
        try
        {
            $endereco->update([
                "nome" => mb_strtoupper($request->nome),
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

        return redirect()->to('clientes/'.$endereco->cliente_id);
    }

    public function destroy(Endereco $endereco)
    {
        //
    }
}
