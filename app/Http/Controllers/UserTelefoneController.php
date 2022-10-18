<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTelefone;
use Illuminate\Http\Request;

$GLOBALS['regras'] = [
    'nome_telefone' => 'required|min:3|max:30',
    'numero_telefone' => 'required|min:14',
];

$GLOBALS['mensagem']= [
    "nome_telefone.required" => "O preenchimento do campo Nome do Contato é obrigatório!",
    "nome_telefone.max" => "O campo Nome do Contato possui tamanho máxixo de 30 caracteres!",
    "nome_telefone.min" => "O campo Nome do Contato possui tamanho mínimo de 2 caracteres!",
    "numero_telefone.required" => "O preenchimento do campo Contato é obrigatório!",
    "numero_telefone.min" => "O campo Contato possui tamanho mínimo de 10 dígitos!",
];

class UserTelefoneController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        
    }

    public function newTelefone($user) {
        return view('userTelefones.newTelefone', compact(['user']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        $user = User::find($request->user_id);

        $telefone = new userTelefone();
        $telefone->nome = mb_strtoupper($request->nome_telefone);
        $telefone->numero = $request->numero_telefone;
        $telefone->user()->associate($user);
        $telefone->save();

        return redirect()->route('users.show', $user->id);
    }

    public function show(UserTelefone $userTelefone)
    {
        //
    }

    public function edit(UserTelefone $userTelefone)
    {
        return view('userTelefones.edit', compact(['userTelefone']));
    }

    public function update(Request $request, UserTelefone $userTelefone)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try
        {
            $userTelefone->update([
                "nome" => mb_strtoupper($request->nome_telefone),
                "numero" => $request->numero_telefone,
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('users.show', $userTelefone->user_id);
    }

    public function destroy(UserTelefone $userTelefone)
    {
        try
        {
            $userTelefone->delete();
            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
           
        } catch(\Exception $exception)
        { 
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('users.show', $userTelefone->user_id);
    }
}
