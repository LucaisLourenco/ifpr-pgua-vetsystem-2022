<?php

namespace App\Http\Controllers;

use App\Models\ConsultaAgendamento;
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
        return view('consultaagendamentos.create');
    }

    public function store(Request $request)
    {
        $startDateTime = Carbon::parse($request->dataAgendamento.''.$request->horaAgendamento);
        $endDateTime = (clone $startDateTime)->addHour();

        Event::create([
            'name' => 'Consulta',
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
         ]);
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
