@extends('templates.main', ['titulo' => "Clientes", 'rota' => "clientes.create"])

@section('titulo') Clientes @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-users
                :title="'Clientes'"
                :route="'clientes'"
                :header="['ID', 'NOME', 'CPF', 'STATUS', 'AÇÕES']" 
                :data="$clientes"
                :hide="[true, true, true, true, false]" 
            />
        </div>
    </div>
@endsection