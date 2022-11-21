<?php

namespace App\Http\Controllers;

use App\Facades\UserPermissions;
use App\Models\Veterinario;
use App\Models\VeterinarioEndereco;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'cep' => 'required|min:10',
    'nome_endereco' => 'required|min:3|max:30',
    'rua' => 'required|max:60',
    'bairro' => 'required|min:3|max:60',
    'cidade' => 'required|min:3|max:30',
    'numero_endereco' => 'required|max:10',
    'uf' => 'required|min:2|max:2',
];

$GLOBALS['mensagem']= [
    "cep.required" => "O preenchimento do campo CEP é obrigatório!",
    "cep.min" => "O campo CEP possui tamanho mínimo de 8 dígitos!",
    "uf.required" => "O preenchimento do campo UF é obrigatório!",
    "uf.max" => "O campo UF possui tamanho máxixo de 2 caracteres!",
    "uf.min" => "O campo UF possui tamanho mínimo de 2 caracteres!",
    "cidade.required" => "O preenchimento do campo Cidade é obrigatório!",
    "cidade.max" => "O campo Cidade possui tamanho máxixo de 30 caracteres!",
    "cidade.min" => "O campo Cidade possui tamanho mínimo de 3 caracteres!",
    "bairro.required" => "O preenchimento do campo Bairro é obrigatório!",
    "bairro.max" => "O campo Bairro possui tamanho máxixo de 60 caracteres!",
    "bairro.min" => "O campo Bairro possui tamanho mínimo de 3 caracteres!",
    "numero_endereco.required" => "O preenchimento do campo Número é obrigatório!",
    "numero_endereco.max" => "O campo Número possui tamanho máxixo de 10 dígitos!",
    "nome_endereco.required" => "O preenchimento do campo Nome do Endereço é obrigatório!",
    "nome_endereco.max" => "O campo Nome do Endereço possui tamanho máxixo de 30 caracteres!",
    "nome_endereco.min" => "O campo Nome do Endereço possui tamanho mínimo de 2 caracteres!",
    "rua.required" => "O preenchimento do campo Rua é obrigatório!",
    "rua.max" => "O campo Rua possui tamanho máxixo de 30 caracteres!",
];

class VeterinarioEnderecoController extends Controller
{
    public function __construct() {
        $this->authorizeResource(VeterinarioEndereco::class, 'veterinarioEndereco');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function newEndereco($veterinario) 
    {
        if(!UserPermissions::isAuthorized('veterinarioEnderecos.create')) {
            return abort(redirect()->route('acessonegado.index'));
        }

        return view('veterinarioEnderecos.newEndereco', compact(['veterinario']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $veterinario = Veterinario::find($request->veterinario_id);

        $endereco = new VeterinarioEndereco();
        $endereco->nome = mb_strtoupper($request->nome_endereco);
        $endereco->cep = $request->cep;
        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero_endereco;
        $endereco->complemento = $request->complemento;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->uf = mb_strtoupper($request->uf);
        $endereco->veterinario()->associate($veterinario);
        $endereco->save();

        return redirect()->route('veterinarios.show', $veterinario->id);
    }

    public function show(VeterinarioEndereco $veterinarioEndereco)
    {
        //
    }

    public function edit(VeterinarioEndereco $veterinarioEndereco)
    {
        return view('veterinarioEnderecos.edit', compact(['veterinarioEndereco']));
    }

    public function update(Request $request, VeterinarioEndereco $veterinarioEndereco)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $veterinarioEndereco->update([
                "nome" => mb_strtoupper($request->nome_endereco),
                "cep" => $request->cep,
                "rua" => $request->rua,
                "numero" => $request->numero_endereco,
                "complemento" => $request->complemento,
                "bairro" => $request->bairro,
                "cidade" => $request->cidade,
                "uf" => mb_strtoupper($request->uf)
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('veterinarios.show', $veterinarioEndereco->veterinario_id);
    }

    public function destroy(VeterinarioEndereco $veterinarioEndereco)
    {
        try
        {
            $veterinarioEndereco->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
           
        } catch(\Exception $exception)
        { 
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('veterinarios.show', $veterinarioEndereco->veterinario_id);
    }
}
