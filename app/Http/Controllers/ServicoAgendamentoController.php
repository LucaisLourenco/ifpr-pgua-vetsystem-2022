<?php

namespace App\Http\Controllers;

use App\Models\ServicoAgendamento;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class ServicoAgendamentoController extends Controller
{
    public function index()
    {
        $servicoAgendamentos = ServicoAgendamento::all();

        return view('servicoagendamentos.index', compact(['servicoAgendamentos']));
    }

    public function create()
    {
        return view('servicoagendamentos.create');
    }

    public function store(Request $request)
    {
        Event::create([
            'name' => 'Consulta',
            'startDateTime' => $request->startDateTime,
            'endDateTime' => $request->endDateTime,
         ]);
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
