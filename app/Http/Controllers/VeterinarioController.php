<?php

namespace App\Http\Controllers;

use App\Events\VeterinarioCreateEvent;
use App\Models\Especialidade;
use App\Models\Genero;
use App\Models\Veterinario;
use App\Models\VeterinarioEndereco;
use App\Models\VeterinarioTelefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

$GLOBALS['regras'] = [
    'name' => 'required|max:100|min:2',
    'cpf' => 'required|min:14|unique:veterinarios',
    'email' => 'required|string|email|max:255|unique:veterinarios',
    'nome_telefone' => 'required|min:3|max:30',
    'numero_telefone' => 'required|min:14',
    'cep' => 'required|min:10',
    'genero_id' => 'required',
    'especialidade_id' => 'required',
    'data_nascimento' => 'required',
    'nome_endereco' => 'required|min:3|max:30',
    'rua' => 'required|max:60',
    'bairro' => 'required|min:3|max:60',
    'cidade' => 'required|min:3|max:30',
    'numero_endereco' => 'required|max:10',
    'uf' => 'required|min:2|max:2',
    'crmv' => 'required|max:10|min:5|unique:veterinarios',
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
    "especialidade_id.required" => "A seleção do campo Especialidade é obrigatório!",
    "crmv.max" => "O campo CRMV possui tamanho máxixo de 10 números!",
    "crmv.min" => "O campo CRMV possui tamanho mínimo de 5 números!",
    "crmv.unique" => "O CRMV informado já existe!",
    "numero_endereco.required" => "O preenchimento do campo Número é obrigatório!",
    "numero_endereco.max" => "O campo Número possui tamanho máxixo de 10 dígitos!",
    "nome_endereco.required" => "O preenchimento do campo Nome do Endereço é obrigatório!",
    "nome_endereco.max" => "O campo Nome do Endereço possui tamanho máxixo de 30 caracteres!",
    "nome_endereco.min" => "O campo Nome do Endereço possui tamanho mínimo de 2 caracteres!",
    "rua.required" => "O preenchimento do campo Rua é obrigatório!",
    "rua.max" => "O campo Rua possui tamanho máxixo de 30 caracteres!",
    "data_nascimento.required" => "O preenchimento do campo Data de Nascimento é obrigatório!"
];

class VeterinarioController extends Controller
{
    public function index()
    {
        $veterinarios = Veterinario::with(['especialidade'])->get();

        return view('veterinarios.index', compact(['veterinarios']));
    }

    public function create()
    {
        $generos = Genero::all();
        $especialidades = Especialidade::all();

        return view('veterinarios.create', compact(['generos', 'especialidades']));
    }

    public function store(Request $request)
    {
        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);
        $password = strtoupper(substr(bin2hex(random_bytes(4)), 1));

        try 
        {
            $veterinario = Veterinario::create([
                "name" => mb_strtoupper($request->name),
                'crmv' => $request->crmv,
                'email' => $request->email,
                'password' => Hash::make($password),
                'cpf' => $request->cpf,
                'genero_id' => $request->genero_id,
                'especialidade_id' => $request->especialidade_id,
                'data_nascimento' => $request->data_nascimento,
                'ativo' => 1
            ]);

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

            $telefone = new VeterinarioTelefone();
            $telefone->nome = mb_strtoupper($request->nome_telefone);
            $telefone->numero = $request->numero_telefone;
            $telefone->veterinario()->associate($veterinario);
            $telefone->save();

            event(new VeterinarioCreateEvent($veterinario, $password));

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception)
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('veterinarios.index');
    }

    public function show(Veterinario $veterinario)
    {
        $veterinario = Veterinario::with('enderecos','telefones','especialidade','genero')->findOrFail($veterinario->id);

        return view('veterinarios.show', compact(['veterinario']));
    }

    public function edit(Veterinario $veterinario)
    {
        $generos = Genero::all();

        if(!array_exists_in_array($generos, $veterinario->genero)) {
            $generos->push($veterinario->genero);
        }

        $especialidades = Especialidade::all();

        if(!array_exists_in_array($especialidades, $veterinario->especialidade)) {
            $especialidades->push($veterinario->especialidade);
        }

        return view('veterinarios.edit', compact(['veterinario','generos', 'especialidades']));
    }

    public function update(Request $request, Veterinario $veterinario)
    {
        $regras = [
            'name' => 'required|max:100|min:2',
            'crmv' => ['required','max:10','min:5',Rule::unique('veterinarios')->ignore($veterinario->id)], 
            'cpf' => ['required','min:14',Rule::unique('veterinarios')->ignore($veterinario->id)],
            'email' => ['required','string','email','max:255',Rule::unique('veterinarios')->ignore($veterinario->id)],
            'genero_id' => 'required',
            'especialidade_id' => 'required',
            'data_nascimento' => 'required',
        ];

        $request->validate($regras,$GLOBALS['mensagem']);

        try
        {
            $veterinario->update([
                "name" => mb_strtoupper($request->name),
                'crmv' => $request->crmv,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'genero_id' => $request->genero_id,
                'especialidade_id' => $request->especialidade_id,
                'data_nascimento' => $request->data_nascimento,
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('veterinarios.show', $veterinario->id);
    }

    public function destroy(Veterinario $veterinario)
    {
        try
        {
            $veterinario->delete();

            session()->flash('mensagem', "Item excluído com sucesso.");
            session()->flash('resultado', true);
            
        } catch(\Exception $exception)
        { 
           session()->flash('mensagem', $exception->getMessage());
           session()->flash('resultado', null);
        }

        return redirect()->route('veterinarios.index');
    }
}
