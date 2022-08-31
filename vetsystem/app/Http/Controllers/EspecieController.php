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

        try
        {
            $resultado = Especie::create([
                "nome" => mb_strtoupper($request->nome)
            ]);

            session(['resultado' => $resultado]);

            if($resultado != null) {
                session(['mensagem' => "Item cadastrado com sucesso."]);
            }

        } catch(\Exception $exception)
        {
            session(['mensagem' => $exception->getMessage()]);
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

        try
        {
            $resultado = $especy->update([
                "nome" => mb_strtoupper($request->nome)
            ]);

            session(['resultado' => $resultado]);

            if($resultado != null) {
                session(['mensagem' => "Item alterado com sucesso"]);
            }

        } catch(\Exception $exception) 
        {
            session(['mensagem' => $exception->getMessage()]);
        }

        return redirect()->route('especies.index');
    }

    public function destroy(Especie $especy)
    {
        try
        {
           $resultado = $especy->delete();

           session(['resultado' => $resultado]);

           if($resultado != null) {
                session(['mensagem' => "Item excluído com sucesso."]);
            }
            
        } catch(\Exception $exception)
        { 
            session(['mensagem' => $exception->getMessage()]);
        }

        return redirect()->route('especies.index');
    }
}
