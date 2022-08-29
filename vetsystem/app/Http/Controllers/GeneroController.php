<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome' => 'required|max:50|min:10',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 50 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 10 caracteres!",
];

class GeneroController extends Controller
{
    public function index()
    {
        $generos = Genero::all();

        return view('generos.index', compact(['generos']));
    }

    public function create()
    {
        return view('generos.create');
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        Genero::create([
            "nome" => mb_strtoupper($request->nome)
        ]);

        return redirect()->route('generos.index');
    }

    public function show(Genero $genero)
    {
        return view('generos.show', compact(['genero']));
    }

    public function edit(Genero $genero)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        return view('generos.edit', compact(['genero']));
    }

    public function update(Request $request, Genero $genero)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $genero->update([
            "nome" => mb_strtoupper($request->nome)
        ]);

        return redirect()->route('generos.index');
    }

    public function destroy(Genero $genero)
    {
        try
        {
            $genero->delete();
            
        } catch(\Illuminate\Database\QueryException $ex)
        { 
            session(['mensagem' => $ex->getMessage()]);
        }

        return redirect()->route('generos.index');
    }
}
