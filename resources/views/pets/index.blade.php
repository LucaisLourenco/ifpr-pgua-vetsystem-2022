@extends('templates.main', ['titulo' => "Pets", 'rota' => "pets.create"])

@section('titulo')- Pets @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist
                :title="'Pets'"
                :route="'pets'"
                :header="['ID', 'NOME', 'AÇÕES']" 
                :data="$pets"
                :hide="[true, true, false]" 
            />
        </div>
    </div>
@endsection