<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Genero;
use App\Models\ClienteEndereco;
use App\Models\ClienteTelefone;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use App\Events\ClienteCreateEvent;
use App\Facades\UserPermissions;

$GLOBALS['regras'] = [
    'name' => 'required|max:100|min:2',
    'cpf' => 'required|min:14|unique:clientes',
    'email' => 'required|string|email|max:255|unique:clientes',
    'genero_id' => 'required',
    'data_nascimento' => 'required',
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
    "numero_endereco.required" => "O preenchimento do campo Número é obrigatório!",
    "numero_endereco.max" => "O campo Número possui tamanho máxixo de 10 dígitos!",
    "nome_endereco.required" => "O preenchimento do campo Nome do Endereço é obrigatório!",
    "nome_endereco.max" => "O campo Nome do Endereço possui tamanho máxixo de 30 caracteres!",
    "nome_endereco.min" => "O campo Nome do Endereço possui tamanho mínimo de 2 caracteres!",
    "rua.required" => "O preenchimento do campo Rua é obrigatório!",
    "rua.max" => "O campo Rua possui tamanho máxixo de 30 caracteres!",
    "data_nascimento.required" => "O preenchimento do campo Data de Nascimento é obrigatório!",
    "password.confirmed" => "As senhas não coincidem!",
    "password.required" => "O preenchimento do campo Senha é obrigatório!",
    "password.min" => "O campo Senha possui tamanho mínimo de 8 caracteres!",
];

class ClienteController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Cliente::class, 'cliente');
    }

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
        $password = strtoupper(substr(bin2hex(random_bytes(4)), 1));

        $verificador_de_endereco = false;
        $verificador_de_telefone = false;

        if($request->nome_telefone != null or $request->numero_telefone != null) {
            
            $regras_telefone = [
                'nome_telefone' => 'required|min:3|max:30',
                'numero_telefone' => 'required|min:14',
            ];

            $request->validate($regras_telefone,$GLOBALS['mensagem']);

            $verificador_de_telefone = true;
        }

        if($request->nome_endereco != null or $request->cep != null or $request->rua != null
            or $request->numero_complemento != null or $request->bairro != null or $request->cidade != null) {
            
            $regras_endereco = [
                'cep' => 'required|min:10',
                'nome_endereco' => 'required|min:3|max:30',
                'rua' => 'required|max:60',
                'bairro' => 'required|min:3|max:60',
                'cidade' => 'required|min:3|max:30',
                'numero_endereco' => 'required|max:10',
                'uf' => 'required|min:2|max:2',
            ];

            $request->validate($regras_endereco,$GLOBALS['mensagem']);

            $verificador_de_endereco = true;
        }

        try 
        {
            $cliente = Cliente::create([
                "name" => mb_strtoupper($request->name),
                'email' => $request->email,
                'password' => Hash::make($password),
                'cpf' => $request->cpf,
                'genero_id' => $request->genero_id,
                'data_nascimento' => $request->data_nascimento,
                'ativo' => 1
            ]);
            
            if($verificador_de_endereco == true ) {
                $endereco = new ClienteEndereco();
                $endereco->nome = mb_strtoupper($request->nome_endereco);
                $endereco->cep = $request->cep;
                $endereco->rua = $request->rua;
                $endereco->numero = $request->numero_endereco;
                $endereco->complemento = $request->complemento;
                $endereco->bairro = $request->bairro;
                $endereco->cidade = $request->cidade;
                $endereco->uf = mb_strtoupper($request->uf);
                $endereco->cliente()->associate($cliente);
                $endereco->save();
            }

            if($verificador_de_telefone == true ) {
                $telefone = new ClienteTelefone();
                $telefone->nome = mb_strtoupper($request->nome_telefone);
                $telefone->numero = $request->numero_telefone;
                $telefone->cliente()->associate($cliente);
                $telefone->save();
            }

            event(new ClienteCreateEvent($cliente, $password));

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
        $cliente = Cliente::with('enderecos','telefones','pets','genero')->findOrFail($cliente->id);

        return view('clientes.show', compact(['cliente']));
    }

    public function edit(Cliente $cliente)
    {
        $generos = Genero::all();

        if(!array_exists_in_array($generos, $cliente->genero)) {
            $generos->push($cliente->genero);
        }

        return view('clientes.edit', compact(['cliente','generos']));
    }

    public function update(Request $request, Cliente $cliente)
    {

        $regras = [
            'name' => 'required|max:100|min:2',
            'cpf' => ['required','min:14',Rule::unique('clientes')->ignore($cliente->id)],
            'email' => ['required','string','email','max:255',Rule::unique('clientes')->ignore($cliente->id)],
            'genero_id' => 'required',
            'data_nascimento' => 'required',
        ];

        $request->validate($regras,$GLOBALS['mensagem']);

        try
        {
            $cliente->update([
                "name" => mb_strtoupper($request->name),
                'email' => $request->email,
                'cpf' => $request->cpf,
                'genero_id' => $request->genero_id,
                'data_nascimento' => $request->data_nascimento,
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('clientes.show', $cliente->id);
    }

    public function destroy(Cliente $cliente)
    {
        try
        {
            foreach($cliente->pets as $item) {
                $item->delete();
            }

            $cliente->delete();

            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
            
        } catch(\Exception $exception)
        { 
           session()->flash('mensagem', $exception->getMessage());
           session()->flash('resultado', null);
        }

        return redirect()->route('clientes.index');
    }

    public function redefinirSenha(Cliente $cliente)
    {
        if(!UserPermissions::isAuthorized('clientes.newSenha')) {
            return abort(redirect()->route('acessonegado.index'));
        }

        return view('clientes.redefinirSenha', compact(['cliente']));
    }

    public function newSenha(Request $request, Cliente $cliente) {

        if(!UserPermissions::isAuthorized('clientes.newSenha')) {
            return abort(redirect()->route('acessonegado.index'));
        }

        $regras = [
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ];
       
        $request->validate($regras,$GLOBALS['mensagem']);

        try
        {
            $cliente->update([
                'password' => Hash::make($request->password),
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('clientes.show', $cliente->id);
    }
}
