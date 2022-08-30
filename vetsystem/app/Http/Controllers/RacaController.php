<?php

namespace App\Http\Controllers;

use App\Models\Raca;
use App\Models\Especie;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome' => 'required|max:30|min:2',
    'especie_id' => 'required'
];

$GLOBALS['mensagem']= [
    "nome.required" => "O preenchimento do campo NOME é obrigatório!",
    "nome.max" => "O campo NOME possui tamanho máxixo de 30 caracteres!",
    "nome.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
    "especie_id.required" => "O preenchimento do campo ESPÉCIE é obrigatório!",
];

class RacaController extends Controller
{
    public function index()
    {
        $racas = Raca::with(['especie'])->get();
        $racas->toJson();

        return view('racas.index', compact(['racas']));
    }

    public function create()
    {
        $especies = Especie::all();

        return view('racas.create', compact(['especies']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $especie = Especie::find($request->especie_id);        
        $raca = new Raca();
        $raca->nome = mb_strtoupper($request->nome);
        $raca->especie()->associate($especie);
        $verify = $raca->save();

        session(['verify' => $verify]);

        if($verify == true) {
            session(['mensagem' => "Item cadastrado com sucesso"]);
        }

        return redirect()->route('racas.index');
    }

    public function show(Raca $raca)
    {
        return view('racas.show', compact(['raca']));
    }

    public function edit(Raca $raca)
    {
        $especies = Especie::all();

        return view('racas.edit', compact(['raca','especies']));
    }

    public function update(Request $request, Raca $raca)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);
     
        $verify = $raca->update([
            "nome" => mb_strtoupper($request->nome),
            "especie_id" => $request->especie_id
        ]);

        session(['verify' => $verify]);

        if($verify == true) {
            session(['mensagem' => "Item alterado com sucesso"]);
        }

        return redirect()->route('racas.index');
    }

    public function destroy(Raca $raca)
    {
        try
        {
           $verify = $raca->delete();

           session(['verify' => $verify]);

           if($verify == true) {
                session(['mensagem' => "Item excluído com sucesso"]);
            }
            
        } catch(\Illuminate\Database\QueryException $exception)
        { 
            session(['mensagem' => "Erro ao excluir o item desejado"]);
        }

        return redirect()->route('racas.index');
    }
}
