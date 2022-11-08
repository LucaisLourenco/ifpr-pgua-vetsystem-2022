@extends('templates.main', ['titulo' => "Serviços", 'rota' => "servicoagendamentos.create"])

@section('titulo')- Serviços @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist
                :title="'Serviços'"
                :route="'servicoagendamentos'"
                :header="['ID', 'VETERINÁRIO', 'PET & TUTOR', 'CATEGORIA', 'DATA', 'HORÁRIO', 'STATUS', 'AÇÕES']" 
                :data="$servicoAgendamentos"
                :hide="[true, true, true, true, true, true, true, false]" 
            />
        </div>
    </div>
@endsection