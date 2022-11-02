@extends('templates.main', ['titulo' => "Status", 'rota' => "statuses.create"])

@section('titulo')- Status @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist
                :title="'Status'"
                :route="'statuses'"
                :header="['ID', 'NOME', 'AÇÕES']" 
                :data="$statuses"
                :hide="[true, true, false]" 
            />
        </div>
    </div>
@endsection