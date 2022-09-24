<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;
use App\Facades\UserPermissions;

$GLOBALS['regras'] = [
    'nome' => 'required|max:30|min:2',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 30 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
];

class GeneroController extends Controller
{
    /*public function __construct() {
        $this->authorizeResource(Genero::class, 'genero');
    }*/
 
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

        try 
        {
            Genero::create([
                "nome" => mb_strtoupper($request->nome)
            ]);

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception)
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('generos.index');
    }

    public function show(Genero $genero)
    {
        return view('generos.show', compact(['genero']));
    }

    public function edit(Genero $genero)
    {
        return view('generos.edit', compact(['genero']));
    }

    public function update(Request $request, Genero $genero)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);
        
        try
        {
            $genero->update([
                "nome" => mb_strtoupper($request->nome)
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('generos.index');
    }

    public function destroy(Genero $genero)
    {
        try
        {
            $genero->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
            
        } catch(\Exception $exception)
        { 
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('generos.index');
    }
}
