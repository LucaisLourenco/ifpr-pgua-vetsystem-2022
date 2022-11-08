@extends('templates.main', ['titulo' => "Consultas", 'rota' => "consultaagendamentos.create"])

@section('titulo')- Consultas @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist
                :title="'Consultas'"
                :route="'consultaagendamentos'"
                :header="['ID', 'VETERINÁRIO', 'PET & TUTOR', 'DATA', 'HORÁRIO', 'STATUS', 'AÇÕES']" 
                :data="$consultaAgendamentos"
                :hide="[true, true, true, true, true, true, false]" 
            />
        </div>
    </div>
@endsection