<?php

namespace App\Http\Controllers;

use App\Models\ConsultaAgendamento;
use App\Models\Peso;
use App\Models\Pet;
use App\Models\PetObservacao;
use App\Models\ServicoAgendamento;
use App\Models\Status;
use App\Models\Veterinario;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    public function atendimentos(Veterinario $veterinario)
    {
        $consultas = ConsultaAgendamento::where('veterinario_id', $veterinario->id)
            ->orderBy('data_consulta', 'ASC')->orderBy('horario_consulta', 'ASC')->get();
    
        $servicos = ServicoAgendamento::where('veterinario_id', $veterinario->id)
            ->orderBy('data_servico', 'ASC')->orderBy('horario_servico', 'ASC')->get();

        return view('atendimentos.index', compact(['consultas','servicos']));
    }

    public function atendimentoConsulta(ConsultaAgendamento $consultaAgendamento) {

        $statuses = Status::all();

        return view('atendimentos.atendimentoconsulta', compact(['consultaAgendamento', 'statuses']));
    }

    public function novoPeso(ConsultaAgendamento $consultaAgendamento)
    {
        return view('atendimentos.novoPeso', compact(['consultaAgendamento']));
    }

    public function adicionarPeso(Request $request)
    {
        $regras = [
            'peso' => 'required|max:7|min:4'  
        ];
        
        $mensagem = [
            "peso.required" => "O preenchimento do campo Peso é obrigatório!",
            "peso.max" => "O campo Peso possui tamanho máxixo de 6 caracteres!",
            "peso.min" => "O campo Peso possui tamanho mínimo de 4 caracteres!"
        ];

        $request->validate($regras, $mensagem);

        $pet = Pet::find($request->pet_id);
        $consultaAgendamento = ConsultaAgendamento::find($request->consulta_id);

        $peso = new Peso();
        $peso->peso = mb_strtoupper($request->peso);
        $peso->pet()->associate($pet);
        $peso->save();

        return redirect()->route('atendimentos.atendimentoconsulta', $consultaAgendamento);
    }

    public function novaObservacao(ConsultaAgendamento $consultaAgendamento)
    {
        return view('atendimentos.novaObservacao', compact(['consultaAgendamento']));
    }

    public function adicionarObservacao(Request $request)
    {
        $regras = [
            'tipo' => 'required|max:30|min:4'  
        ];
        
        $mensagem = [
            "tipo.required" => "O preenchimento do campo Tipo é obrigatório!",
            "tipo.max" => "O campo Tipo possui tamanho máxixo de 30 caracteres!",
            "tipo.min" => "O campo Tipo possui tamanho mínimo de 4 caracteres!"
        ];

        $request->validate($regras, $mensagem);

        $pet = Pet::find($request->pet_id);
        $veterinario = Veterinario::find($request->veterinario_id);
        $consultaAgendamento = ConsultaAgendamento::find($request->consulta_id);

        $petobservacao = new PetObservacao();
        $petobservacao->tipo = mb_strtoupper($request->tipo);
        $petobservacao->descricao = $request->descricao;
        $petobservacao->pet()->associate($pet);
        $petobservacao->veterinario()->associate($veterinario);
        $petobservacao->save();

        return redirect()->route('atendimentos.atendimentoconsulta', $consultaAgendamento);
    }
}
