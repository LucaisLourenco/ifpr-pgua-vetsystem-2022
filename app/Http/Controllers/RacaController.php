<?php

namespace App\Http\Controllers;

use App\Models\Raca;
use App\Models\Especie;
use Illuminate\Http\Request;
use App\Facades\UserPermissions;
use Illuminate\Support\Facades\Response;

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
    /*public function __construct() {
        $this->authorizeResource(Raca::class, 'raca');
    }*/

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

        try
        {
            $especie = Especie::find($request->especie_id);        
            $raca = new Raca();
            $raca->nome = mb_strtoupper($request->nome);
            $raca->especie()->associate($especie);
            $raca->save();

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
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

        if(!array_exists_in_array($especies, $raca->especie)) {
            $especies->push($raca->especie);
        }

        return view('racas.edit', compact(['raca','especies']));
    }

    public function update(Request $request, Raca $raca)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);
     
        try
        {
            $raca->update([
                "nome" => mb_strtoupper($request->nome),
                "especie_id" => $request->especie_id
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('racas.index');
    }

    public function destroy(Raca $raca)
    {
        try
        {
            $raca->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
           
        } catch(\Exception $exception)
        { 
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('racas.index');
    }

    public function selectRaca(Request $request) {
        $racas = Raca::where('especie_id', $request->especie_id)->get();

        return response()->json($racas);
    }
}
