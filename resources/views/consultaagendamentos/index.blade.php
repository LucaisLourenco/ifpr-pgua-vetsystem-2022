@extends('templates.main', ['titulo' => "Consultas", 'rota' => "consultaagendamentos.create"])

@section('titulo')- Consultas @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist
                :title="'Consultas'"
                :route="'consultaagendamentos'"
                :header="['ID', 'AÇÕES']" 
                :data="$consultaAgendamentos"
                :hide="[true, false]" 
            />
        </div>
    </div>
@endsection