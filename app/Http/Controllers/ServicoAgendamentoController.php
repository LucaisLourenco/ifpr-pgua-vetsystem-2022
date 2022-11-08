<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Servico;
use App\Models\ServicoAgendamento;
use App\Models\Veterinario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

$GLOBALS['regras'] = [
    'dataServico' => 'required',
    'horarioServico' => 'required',
    'pet_id' => 'required',
    'veterinario_id' => 'required',
    'servico_id' => 'required',
];

$GLOBALS['mensagem']= [
    "dataServico.required" => "O preenchimento do campo Data da Serviço é obrigatório!",
    "horarioServico.required" => "O preenchimento do campo Horário da Serviço é obrigatório!",
    "pet_id.required" => "A seleção do campo Pet é obrigatório!",
    "veterinario_id.required" => "A seleção do campo Veterinário é obrigatório!",
    "servico_id.required" => "A seleção do campo Serviço é obrigatório!",
];

class ServicoAgendamentoController extends Controller
{
    public function index()
    {
        $servicoAgendamentos = ServicoAgendamento::all();

        return view('servicoagendamentos.index', compact(['servicoAgendamentos']));
    }

    public function create()
    {
        $pets = Pet::all();

        $veterinarios = Veterinario::all();

        $servicos = Servico::all();

        return view('servicoagendamentos.create', compact(['pets','veterinarios','servicos']));
    }

    public function store(Request $request)
    {
        $pet = Pet::find($request->pet_id);
        $veterinario = Veterinario::find($request->veterinario_id);
        $servico = Servico::find($request->servico_id);

        $request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);
     
        try 
        {
            $servicoAgendamento = new ServicoAgendamento();
            $servicoAgendamento->pet()->associate($pet);
            $servicoAgendamento->veterinario()->associate($veterinario); 
            $servicoAgendamento->servico()->associate($servico);    
            $servicoAgendamento->data_servico = $request->dataServico;
            $servicoAgendamento->horario_servico = $request->horarioServico;
            $servicoAgendamento->status_id = 1;
            $servicoAgendamento->save();

            session()->flash('mensagem', "Item cadastrado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }


        return redirect()->route('servicoagendamentos.index');
    }

    public function show(ServicoAgendamento $servicoAgendamento)
    {
        //
    }

    public function edit(ServicoAgendamento $servicoAgendamento)
    {
        //
    }

    public function update(Request $request, ServicoAgendamento $servicoAgendamento)
    {
        //
    }

    public function destroy(ServicoAgendamento $servicoAgendamento)
    {
        //
    }
}
