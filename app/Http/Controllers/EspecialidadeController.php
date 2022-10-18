<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome' => 'required|max:30|min:2',
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 30 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
];

class EspecialidadeController extends Controller
{
    public function index()
    {
        $especialidades = Especialidade::all();

        return view('especialidades.index', compact(['especialidades']));
    }

    public function create()
    {
        return view('especialidades.create');
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try 
        {
            Especialidade::create([
                "nome" => mb_strtoupper($request->nome)
            ]);

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('especialidades.index');
    }

    public function show(Especialidade $especialidade)
    {
        //
    }

    public function edit(Especialidade $especialidade)
    {
        return view('especialidades.edit', compact(['especialidade']));
    }

    public function update(Request $request, Especialidade $especialidade)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $especialidade->update([
                "nome" => mb_strtoupper($request->nome)
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('especialidades.index');
    }

    public function destroy(Especialidade $especialidade)
    {
        try
        {
            $especialidade->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
            
        } catch(\Exception $exception)
        { 
           session()->flash('mensagem', $exception->getMessage());
           session()->flash('resultado', null);
        }

        return redirect()->route('especialidades.index');
    }
}
