@extends('templates.main', ['titulo' => "Especialidades", 'rota' => "especialidades.create"])

@section('titulo')- Especialidades @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist
                :title="'Especialidades'"
                :route="'especialidades'"
                :header="['ID', 'NOME', 'AÇÕES']" 
                :data="$especialidades"
                :hide="[true, true, false]" 
            />
        </div>
    </div>
@endsection