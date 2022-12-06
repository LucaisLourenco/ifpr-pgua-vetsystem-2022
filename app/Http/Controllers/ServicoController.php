<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome' => 'required|max:40|min:2',
    'valor' => 'required',
    'descricao' => 'max:250|min:2',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 40 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
    "valor.required" => "O preenchimento do campo Valor é obrigatório!",
    "descricao.max" => "O campo Descrição possui tamanho máxixo de 250 caracteres!",
    "descricao.min" => "O campo Descrição possui tamanho mínimo de 2 caracteres!",
];

class ServicoController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Servico::class, 'servico');
    }

    public function index()
    {
        $servicos = Servico::all();

        return view('servicos.index', compact(['servicos']));
    }

    public function create()
    {
        return view('servicos.create');
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try 
        {
            Servico::create([
                "nome" => mb_strtoupper($request->nome),
                "valor" => $request->valor,
                "descricao" => $request->descricao
            ]);

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('servicos.index');
    }

    public function show(Servico $servico)
    {
        //
    }

    public function edit(Servico $servico)
    {
        return view('servicos.edit', compact(['servico']));
    }

    public function update(Request $request, Servico $servico)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);
        
        try
        {
            $servico->update([
                "nome" => mb_strtoupper($request->nome),
                "valor" => $request->valor,
                "descricao" => $request->descricao
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('servicos.index');
    }

    public function destroy(Servico $servico)
    {
        //
    }
}
