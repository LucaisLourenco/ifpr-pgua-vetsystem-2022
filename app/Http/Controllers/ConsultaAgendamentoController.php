<?php

namespace App\Http\Controllers;

use App\Models\ConsultaAgendamento;
use App\Models\Pet;
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

    public function edit(ConsultaAgendamento $consultaAgendamento)
    {
        //
    }

    public function update(Request $request, ConsultaAgendamento $consultaAgendamento)
    {
        //
    }

    public function destroy(ConsultaAgendamento $consultaAgendamento)
    {
        //
    }
}
