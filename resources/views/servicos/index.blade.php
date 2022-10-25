@extends('templates.main', ['titulo' => "Serviços", 'rota' => "servicos.create"])

@section('titulo')- Serviços @endsection

@section('conteudo')

    <div class="row">
        <div class="col">   
            <x-datalist
                :title="'Serviços'"
                :route="'servicos'"
                :header="['ID', 'NOME', 'VALOR', 'DESCRIÇÃO', 'AÇÕES']" 
                :data="$servicos"
                :hide="[true, true, true, true, false]" 
            />
        </div>
    </div>
@endsection