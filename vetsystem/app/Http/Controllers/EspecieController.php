<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome' => 'required|max:30|min:2',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 30 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
];

class EspecieController extends Controller
{
    public function index()
    {
        $especies = Especie::all();

        return view('especies.index', compact(['especies']));
    }

    public function create()
    {
        return view('especies.create');
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $verify = Especie::create([
            "nome" => mb_strtoupper($request->nome)
        ]);

        session(['verify' => $verify]);

       if($verify == true) {
            session(['mensagem' => "Item cadastrado com sucesso"]);
        }

        return redirect()->route('especies.index');
    }

    public function show(Especie $especy)
    {
        return view('especies.show', compact(['especy']));
    }

    public function edit(Especie $especy)
    {
        return view('especies.edit', compact(['especy']));
    }

    public function update(Request $request, Especie $especy)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $verify = $especy->update([
            "nome" => mb_strtoupper($request->nome)
        ]);

        session(['verify' => $verify]);

        if($verify == true) {
            session(['mensagem' => "Item alterado com sucesso"]);
        }

        return redirect()->route('especies.index');
    }

    public function destroy(Especie $especy)
    {
        try
        {
           $verify = $especy->delete();

           session(['verify' => $verify]);

           if($verify == true) {
                session(['mensagem' => "Item excluído com sucesso"]);
            }
            
        } catch(\Illuminate\Database\QueryException $exception)
        { 
            session(['mensagem' => "Erro ao excluir o item desejado"]);
        }

        return redirect()->route('especies.index');
    }
}
