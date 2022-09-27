@extends('templates.main', ['titulo' => "Gêneros", 'rota' => "generos.create"])

@section('titulo')- Gêneros @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist
                :title="'Gêneros'"
                :route="'generos'"
                :header="['ID', 'NOME', 'AÇÕES']" 
                :data="$generos"
                :hide="[true, true, false]" 
            />
        </div>
    </div>
@endsection