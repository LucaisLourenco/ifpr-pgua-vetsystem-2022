<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Genero;
use App\Models\Role;
use App\Models\UserEndereco;
use App\Models\UserTelefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

$GLOBALS['regras'] = [
    'name' => 'required|max:100|min:2',
    'cpf' => 'required|min:14|unique:users',
    'email' => 'required|string|email|max:255|unique:users',
    'nome_telefone' => 'required|min:3|max:30',
    'numero_telefone' => 'required|min:14',
    'cep' => 'required|min:10',
    'genero_id' => 'required',
    'role_id' => 'required',
    'data_nascimento' => 'required',
    'nome_endereco' => 'required|min:3|max:30',
    'rua' => 'required|max:60',
    'bairro' => 'required|min:3|max:60',
    'cidade' => 'required|min:3|max:30',
    'numero_endereco' => 'required|max:10',
    'uf' => 'required|min:2|max:2',
];

$GLOBALS['mensagem']= [
    "name.required" => "O preenchimento do campo NOME é obrigatório!",
    "name.max" => "O campo NOME possui tamanho máxixo de 100 caracteres!",
    "name.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
    "cpf.required" => "O preenchimento do campo CPF é obrigatório!",
    "cpf.min" => "O campo CPF possui tamanho mínimo de 11 dígitos!",
    "cpf.unique" => "O CPF informado já existe!",
    "email.required" => "O preenchimento do campo E-mail é obrigatório!",
    "email.unique" => "O E-mail informado já existe!",
    "email.max" => "O campo E-mail possui tamanho máxixo de 255 caracteres!",
    "nome_telefone.required" => "O preenchimento do campo Nome do Contato é obrigatório!",
    "nome_telefone.max" => "O campo Nome do Contato possui tamanho máxixo de 30 caracteres!",
    "nome_telefone.min" => "O campo Nome do Contato possui tamanho mínimo de 2 caracteres!",
    "numero_telefone.required" => "O preenchimento do campo Contato é obrigatório!",
    "numero_telefone.min" => "O campo Contato possui tamanho mínimo de 10 dígitos!",
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
    "genero_id.required" => "A seleção do campo Gênero é obrigatório!",
    "role_id.required" => "A seleção do campo Função é obrigatório!",
    "numero_endereco.required" => "O preenchimento do campo Número é obrigatório!",
    "numero_endereco.max" => "O campo Número possui tamanho máxixo de 10 dígitos!",
    "nome_endereco.required" => "O preenchimento do campo Nome do Endereço é obrigatório!",
    "nome_endereco.max" => "O campo Nome do Endereço possui tamanho máxixo de 30 caracteres!",
    "nome_endereco.min" => "O campo Nome do Endereço possui tamanho mínimo de 2 caracteres!",
    "rua.required" => "O preenchimento do campo Rua é obrigatório!",
    "rua.max" => "O campo Rua possui tamanho máxixo de 30 caracteres!",
    "data_nascimento.required" => "O preenchimento do campo Data de Nascimento é obrigatório!"
];

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role'])->get();

        return view('users.index', compact(['users']));
    }

    public function create()
    {
        $generos = Genero::all();
        $roles = Role::all();

        return view('users.create', compact(['generos', 'roles']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);
        $password = strtoupper(substr(bin2hex(random_bytes(4)), 1));

        try 
        {
            $user = User::create([
                "name" => mb_strtoupper($request->name),
                'email' => $request->email,
                'password' => Hash::make($password),
                'cpf' => $request->cpf,
                'genero_id' => $request->genero_id,
                'role_id' => $request->role_id,
                'data_nascimento' => $request->data_nascimento,
                'ativo' => 1
            ]);

            $endereco = new UserEndereco();
            $endereco->nome = mb_strtoupper($request->nome_endereco);
            $endereco->cep = $request->cep;
            $endereco->rua = $request->rua;
            $endereco->numero = $request->numero_endereco;
            $endereco->complemento = $request->complemento;
            $endereco->bairro = $request->bairro;
            $endereco->cidade = $request->cidade;
            $endereco->uf = mb_strtoupper($request->uf);
            $endereco->user()->associate($user);
            $endereco->save();

            $telefone = new UserTelefone();
            $telefone->nome = mb_strtoupper($request->nome_telefone);
            $telefone->numero = $request->numero_telefone;
            $telefone->user()->associate($user);
            $telefone->save();

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception)
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $user = User::with('enderecos','telefones','role','genero')->findOrFail($user->id);

        return view('users.show', compact(['user']));
    }

    public function edit(User $user)
    {
        $generos = Genero::all();

        if(!array_exists_in_array($generos, $user->genero)) {
            $generos->push($user->genero);
        }

        $roles = Role::all();

        if(!array_exists_in_array($roles, $user->role)) {
            $roles->push($user->role);
        }

        return view('users.edit', compact(['user','generos','roles']));
    }

    public function update(Request $request, User $user)
    {
        $regras = [
            'name' => 'required|max:100|min:2',
            'cpf' => ['required','min:14',Rule::unique('users')->ignore($user->id)],
            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($user->id)],
            'genero_id' => 'required',
            'role_id' => 'required',
            'data_nascimento' => 'required',
        ];

        $request->validate($regras,$GLOBALS['mensagem']);

        try
        {
            $user->update([
                "name" => mb_strtoupper($request->name),
                'email' => $request->email,
                'cpf' => $request->cpf,
                'genero_id' => $request->genero_id,
                'role_id' => $request->role_id,
                'data_nascimento' => $request->data_nascimento,
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        try
        {
            $user->delete();

            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
            
        } catch(\Exception $exception)
        { 
           session()->flash('mensagem', $exception->getMessage());
           session()->flash('resultado', null);
        }

        return redirect()->route('users.index');
    }
}
