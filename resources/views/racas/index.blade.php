@extends('templates.main', ['titulo' => "Raças", 'rota' => "racas.create"])

@section('titulo')- Raças @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist
                :title="'Raças'"
                :route="'racas'"
                :header="['ID', 'NOME', 'ESPÉCIE', 'AÇÕES']" 
                :data="$racas"
                :hide="[true, true, true, false]" 
            />
        </div>
    </div>
@endsection