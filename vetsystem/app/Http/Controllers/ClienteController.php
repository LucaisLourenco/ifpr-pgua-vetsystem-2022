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
    'cpf' => 'required|unique:clientes',
    'email' => 'required|string|email|max:255|unique:clientes',
    'contato' => 'required|min:14'

];

$GLOBALS['mensagem']= [
    "name.required" => "O preenchimento do campo NOME é obrigatório!",
    "name.max" => "O campo NOME possui tamanho máxixo de 100 caracteres!",
    "name.min" => "O campo NOME possui tamanho mínimo de 2 caracteres!",
    "cpf.required" => "O preenchimento do campo CPF é obrigatório!",
    "cpf.unique" => "O CPF informado já existe!",
    "email.required" => "O preenchimento do campo E-mail é obrigatório!",
    "email.unique" => "O E-mail informado já existe!",
    "email.max" => "O campo E-mail possui tamanho máxixo de 255 caracteres!",
    "contato.min" => "O campo Contato possui tamanho mínimo de 10 dígitos!",
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
            $endereco->uf = $request->uf;
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
        
    }

    public function edit(Cliente $cliente)
    {
        //
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
