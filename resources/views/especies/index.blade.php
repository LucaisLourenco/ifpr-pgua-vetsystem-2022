@extends('templates.main', ['titulo' => "Espécies", 'rota' => "especies.create"])

@section('titulo') Espécies @endsection

@section('conteudo')

    <div class="row">
        <div class="col">   
            <x-datalist
                :title="'Espécies'"
                :route="'especies'"
                :header="['ID', 'NOME', 'AÇÕES']" 
                :data="$especies"
                :hide="[true, true, false]" 
            />
        </div>
    </div>
@endsection