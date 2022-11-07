<?php

namespace App\Http\Controllers;

use App\Models\ConsultaAgendamento;
use App\Models\Pet;
use App\Models\Status;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\GoogleCalendar\Event;

class ConsultaAgendamentoController extends Controller
{
    public function index()
    {
        $consultaAgendamentos = ConsultaAgendamento::all();

        return view('consultaagendamentos.index', compact(['consultaAgendamentos']));
    }

    public function create()
    {
        $pets = Pet::all();

        $veterinarios = Veterinario::all();

        return view('consultaagendamentos.create', compact('pets','veterinarios'));
    }

    public function store(Request $request)
    {
        $pet = Pet::find($request->pet_id);
        $veterinario = Veterinario::find($request->veterinario_id);

        $startDateTime = Carbon::parse($request->dataConsulta.''.$request->horarioConsulta);
        $endDateTime = (clone $startDateTime)->addHour();

        
            $consultaAgendamento = new ConsultaAgendamento();
            $consultaAgendamento->pet()->associate($pet);
            $consultaAgendamento->veterinario()->associate($veterinario);    
            $consultaAgendamento->valor = $request->valor;
            $consultaAgendamento->data_consulta = $request->dataConsulta;
            $consultaAgendamento->horario_consulta = $request->horarioConsulta;
            $consultaAgendamento->status_id = 1;
            $consultaAgendamento->save();

            $event = new Event;
            $event->name = 'Consulta '.$pet->nome;
            $event->description = 'A consulta do cliente '.$pet->cliente->name.' com o Médico Veterinário '.$veterinario->name.' foi agendada para o dia '.$request->dataConsulta.' às '.$request->horarioConsulta.'.';
            $event->startDateTime = $startDateTime;
            $event->endDateTime = $endDateTime;
            $event->save();


        return redirect()->route('consultaagendamentos.index');

        /*

        Event::create([
            'name' => 'Consulta',
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
        ]);

        $event = new Event;
        $event->name = 'A new event';
        $event->description = 'Event description';
        $event->startDateTime = $startDateTime;
        $event->endDateTime = $endDateTime;
        $event->addAttendee(['email' => $request->pet->cliente->email]);
        $event->addAttendee(['email' => $request->veterinario->email]);

        $event->save();*/
    }

    public function show(ConsultaAgendamento $consultaAgendamento)
    {
        //
    }

    public function edit(ConsultaAgendamento $consultaagendamento)
    {
        $statuses = Status::all();

        if(!array_exists_in_array($statuses, $consultaagendamento->status)) {
            $statuses->push($consultaagendamento->status);
        }

        $pets = Pet::all();

        if(!array_exists_in_array($pets, $consultaagendamento->pet)) {
            $pets->push($consultaagendamento->pet);
        }

        $veterinarios = Veterinario::all();

        if(!array_exists_in_array($veterinarios, $consultaagendamento->veterinario)) {
            $veterinarios->push($consultaagendamento->veterinario);
        }

        return view('consultaagendamentos.edit', compact(['consultaagendamento','pets','veterinarios','statuses']));
    }

    public function update(Request $request, ConsultaAgendamento $consultaagendamento)
    {
        //$request->validate($GLOBALS['regras'],$GLOBALS['mensagem']);
     
        try
        {
            $consultaagendamento->update([
                "pet_id" => $request->pet_id,
                "veterinario_id" => $request->veterinario_id,
                "data_consulta" => $request->dataConsulta,
                "horario_consulta" => $request->horarioConsulta,
                "status_id" => $request->status_id,
                "valor" => $request->valor,
                "relatorio" => $request->relatorio,
            ]);

            session()->flash('mensagem', "Item alterado com sucesso.");
            session()->flash('resultado', true);

        } catch(\Exception $exception) 
        {
            session()->flash('mensagem', $exception->getMessage());
            session()->flash('resultado', null);
        }

        return redirect()->route('consultaagendamentos.index');
    }

    public function destroy(ConsultaAgendamento $consultaAgendamento)
    {
        //
    }
}
