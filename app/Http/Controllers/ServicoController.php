<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome' => 'required|max:30|min:2',
    'valor' => 'required',
    'descricao' => 'required|max:250|min:2',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 30 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
    "valor.required" => "O preenchimento do campo Valor é obrigatório!",
    "descricao.required" => "O preenchimento do campo Descrição é obrigatório!",
    "descricao.max" => "O campo Descrição possui tamanho máxixo de 250 caracteres!",
    "descricao.min" => "O campo Descrição possui tamanho mínimo de 2 caracteres!",
];

class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servico::all();

        return view('servicos.index', compact(['servicos']));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Servico $servico)
    {
        //
    }

    public function edit(Servico $servico)
    {
        //
    }

    public function update(Request $request, Servico $servico)
    {
        //
    }

    public function destroy(Servico $servico)
    {
        //
    }
}
