@extends('templates.main', ['titulo' => "Veterinários", 'rota' => "veterinarios.create"])

@section('titulo')- Veterinários @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-users
                :title="'Veterinários'"
                :route="'veterinarios'"
                :header="['ID', 'NOME', 'CRMV', 'E-MAIL', 'STATUS', 'AÇÕES']" 
                :data="$veterinarios"
                :hide="[true, true, true, true, true, false]" 
            />
        </div>
    </div>
@endsection