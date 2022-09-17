@extends('templates.main', ['titulo' => "Clientes", 'rota' => "clientes.create"])

@section('titulo') Clientes @endsection

@section('conteudo')
    <div>    
        <table class="table align-middle caption-top table-striped">
            <caption>Lista de <b>Endereços</b></caption>
            <thead>
                <tr>
                    <th scope="col" class="d-none d-md-table-cell">ID</th>
                    <th scope="col" class="d-none d-md-table-cell">CIDADE</th>
                    <th scope="col" class="d-none d-md-table-cell">UF</th>
                    <th id="coluna-acoes-users" scope="col">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cliente->enderecos as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['cidade'] }}</td>
                        <td>{{ $item['uf'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection