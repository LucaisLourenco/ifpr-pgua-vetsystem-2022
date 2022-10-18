@extends('templates.main', ['titulo' => "Funcionários", 'rota' => "users.create"])

@section('titulo')- Funcionários @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist-users
                :title="'Funcionários'"
                :route="'users'"
                :header="['ID', 'NOME', 'FUNÇÃO', 'E-MAIL', 'STATUS', 'AÇÕES']" 
                :data="$users"
                :hide="[true, true, true, true, true, false]" 
            />
        </div>
    </div>
@endsection