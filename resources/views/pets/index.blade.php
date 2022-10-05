@extends('templates.main', ['titulo' => "Pets", 'rota' => "pets.create"])

@section('titulo')- Pets @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <div>    
                <table class="table align-middle caption-top table-striped">
                    <caption>Tabela de <b>Pets</b></caption>
                    <thead>
                        <tr>    
                            <th scope="col" class="d-none d-md-table-cell">ID</th>
                            <th scope="col" class="d-none d-md-table-cell">NOME</th>
                            <th scope="col" class="d-none d-md-table-cell">TUTOR</th>
                            <th scope="col" class="d-none d-md-table-cell">RAÇA</th>
                            <th scope="col" class="d-none d-md-table-cell">ESPÉCIE</th>
                            <th scope="col" class="d-none d-md-table-cell">STATUS</th>
                            <th id="coluna-acoes-users" scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pets as $item)
                            <tr>
                                <td>{{$item['id'] }}</td>
                                <td>{{$item['nome'] }}</td>
                                <td>{{$item->cliente['name']}}</td>
                                <td>{{$item->raca['nome']}}</td>
                                <td>{{$item->raca->especie['nome']}}</td>
        
                                @if ($item['ativo'] == 1)
                                    <td>ATIVO</td>
                                @else
                                    <td>DESABILITADO</td>
                                @endif
                
                                <td>
                                    <a href= "{{ route('pets.show', $item) }}" class="btn btn-primary">Vizualizar
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection