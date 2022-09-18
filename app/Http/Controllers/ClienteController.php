<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Genero;
use App\Models\Endereco;
use App\Models\Telefone;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;

$GLOBALS['regras'] = [
    'name' => 'required|max:100|min:2',
    'cpf' => 'required|min:14|unique:clientes',
    'email' => 'required|string|email|max:255|unique:clientes',
    'contato' => 'required|min:14',
    'cep' => 'required|min:10',
    'genero_id' => 'required',
    'data_nascimento' => 'required',
    'nome' => 'required|min:3|max:30',
    'rua' => 'required|max:60',
    'bairro' => 'required|min:3|max:60',
    'cidade' => 'required|min:3|max:30',
    'numero' => 'required|max:10',
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
    "contato.required" => "O preenchimento do campo Contato é obrigatório!",
    "contato.min" => "O campo Contato possui tamanho mínimo de 10 dígitos!",
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
    "numero.required" => "O preenchimento do campo Número é obrigatório!",
    "numero.max" => "O campo Número possui tamanho máxixo de 10 dígitos!",
    "nome.required" => "O preenchimento do campo Nome do Endereço é obrigatório!",
    "nome.max" => "O campo Nome do Endereço possui tamanho máxixo de 30 caracteres!",
    "nome.min" => "O campo Nome do Endereço possui tamanho mínimo de 2 caracteres!",
    "rua.required" => "O preenchimento do campo Rua é obrigatório!",
    "rua.max" => "O campo Rua possui tamanho máxixo de 30 caracteres!",
    "data_nascimento.required" => "O preenchimento do campo Data de Nascimento é obrigatório!"
];

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index', compact(['clientes']));
    }

    public function create()
    {
        $generos = Genero::all();

        return view('clientes.create', compact(['generos']));
    }

    public function store(Request $request)
    {
    
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);

        try 
        {
            $cliente = Cliente::create([
                "name" => mb_strtoupper($request->name),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'cpf' => $request->cpf,
                'genero_id' => $request->genero_id,
                'data_nascimento' => $request->data_nascimento,
                'ativo' => 1
            ]);

            $endereco = new Endereco();
            $endereco->nome = mb_strtoupper($request->nome);
            $endereco->cep = $request->cep;
            $endereco->rua = $request->rua;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->bairro = $request->bairro;
            $endereco->cidade = $request->cidade;
            $endereco->uf = mb_strtoupper($request->uf);
            $endereco->cliente()->associate($cliente);
            $endereco->save();

            $telefone = new Telefone();
            $telefone->contato = $request->contato;
            $telefone->cliente()->associate($cliente);
            $telefone->save();

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception)
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('clientes.index');
    }

    public function show(Cliente $cliente)
    {
        $cliente = Cliente::with('enderecos','telefones','genero')->findOrFail($cliente->id);

        ($cliente);
        return view('clientes.show', compact(['cliente']));
    }

    public function edit(Cliente $cliente)
    {
        $generos = Genero::all();

        return view('clientes.edit', compact(['generos']));
    }

    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    public function destroy(Cliente $cliente)
    {
        //
    }
}
