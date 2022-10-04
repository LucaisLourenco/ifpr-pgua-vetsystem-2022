@extends('templates.main', ['titulo' => "Sexos", 'rota' => "sexos.create"])

@section('titulo')- Sexos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">   
            <x-datalist
                :title="'Sexos'"
                :route="'sexos'"
                :header="['ID', 'NOME', 'AÇÕES']" 
                :data="$sexos"
                :hide="[true, true, false]" 
            />
        </div>
    </div>
@endsection