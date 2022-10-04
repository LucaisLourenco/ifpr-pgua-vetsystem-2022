<?php

namespace App\Http\Controllers;

use App\Models\Sexo;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome' => 'required|max:30|min:2',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 30 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
];

class SexoController extends Controller
{
    public function index()
    {
        $sexos = Sexo::all();

        return view('sexos.index', compact(['sexos']));
    }

    public function create()
    {
        return view('sexos.create');
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try 
        {
            Sexo::create([
                "nome" => mb_strtoupper($request->nome)
            ]);

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('sexos.index');
    }

    public function show(Sexo $sexo)
    {
        //
    }

    public function edit(Sexo $sexo)
    {
        return view('sexos.edit', compact(['sexo']));
    }

    public function update(Request $request, Sexo $sexo)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $sexo->update([
                "nome" => mb_strtoupper($request->nome)
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('sexos.index');
    }

    public function destroy(Sexo $sexo)
    {
        try
        {
            $sexo->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
            
        } catch(\Exception $exception)
        { 
           session()->flash('mensagem', $exception->getMessage());
           session()->flash('resultado', null);
        }

        return redirect()->route('sexos.index');
    }
}
