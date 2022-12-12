<?php

namespace App\Http\Controllers;

use App\Models\ConsultaAgendamento;
use App\Models\ServicoAgendamento;
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
}
