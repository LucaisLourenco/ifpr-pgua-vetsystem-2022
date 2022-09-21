@extends('templates.main', ['titulo' => $cliente->name])

@section('titulo') Clientes @endsection

@section('conteudo')
    <h3>Dados Cadastrais</h3>
    <dl class="row">
        <dt class="col-sm-2">Tutor</dt>
        <dd class="col-sm-10">{{ $cliente->name }}</dd>
        
        <dt class="col-sm-2">CPF</dt>
        <dd class="col-sm-10">{{ $cliente->cpf }}</dd>

        <dt class="col-sm-2">E-mail</dt>
        <dd class="col-sm-10">{{ $cliente->email }}</dd>

        <dt class="col-sm-2">Gênero</dt>
        <dd class="col-sm-10">{{ $cliente->genero->nome }}</dd>

        <dt class="col-sm-2">Data de Nascimento</dt>
        <dd class="col-sm-10">{{ $cliente->data_nascimento }}</dd>

        <dt class="col-sm-2">Status</dt>
        
        @if($cliente->ativo == 1)
            <dd class="col-sm-10">Tutor ativo</dd>
        @else
            <dd class="col-sm-10">Tutor desabilitado</dd>
        @endif
    </dl>
    <hr>
    <div class="row">    
        <div class="col-6">   
            <table class="table align-middle caption-top table-striped">
                <caption>Lista de <b>Endereços</b></caption>
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">NOME</th>
                        <th scope="col" class="d-none d-md-table-cell">RUA</th>
                        <th scope="col" class="d-none d-md-table-cell">BAIRRO</th>
                        <th id="coluna-acoes-users-perfil-enderecos" scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cliente->enderecos as $item)
                        <tr>
                            <td>{{ $item['nome'] }}</td>
                            <td>{{ $item['rua'] }}</td>
                            <td>{{ $item['bairro'] }}</td>
                            <td>
                                <a href= "" class="btn btn-success">                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                    </svg>
                                </a>

                                <a nohref style="cursor:pointer" onclick="showInfoModalEndereco('{{ $item['nome'] }}','{{ $item['cep'] }}','{{ $item['rua'] }}',
                                        '{{ $item['numero'] }}','{{ $item['complemento'] }}','{{ $item['bairro'] }}','{{ $item['cidade'] }}',
                                            '{{ $item['uf'] }}')" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </a>

                                <a nohref style="cursor:pointer" onclick="showRemoveModalEndereco('{{ $item['id'] }}', '{{ $item['nome'] }}')" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                            </td>
                            <form action="{{ route('enderecos.destroy', $item['id']) }}" method="POST" id="endereco_{{$item['id']}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col d-flex justify-content-end">
                <a href= "" class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#createModalEndereco">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            </div> 
        </div>
        <div class="col-6">    
            <table class="table align-middle caption-top table-striped">
                <caption>Lista de <b>Contatos</b></caption>
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">NOME DO CONTATO</th>
                        <th scope="col" class="d-none d-md-table-cell">CONTATO</th>
                        <th id="coluna-acoes-users-perfil" scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cliente->telefones as $item)
                        <tr>
                            <td>{{ $item['nome'] }}</td>
                            <td>{{ $item['contato'] }}</td>
                            <td>
                                <a href= "#" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                    </svg>
                                </a>
                                <a nohref style="cursor:pointer" onclick="showRemoveModalTelefone('{{ $item['id'] }}', '{{ $item['contato'] }}')" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                            </td>
                            <form action="" method="POST" id="telefone_{{$item['id']}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col d-flex justify-content-end">
                <a href= "" class="btn btn-secondary text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            </div> 
        </div>
    </div>
   
    @if(session('mensagem') && session('resultado') == false)
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script>
        $(document).ready(function(){
            showInfoModalDanger('{{session('mensagem')}}');
        });
        </script>
    @elseif(session('mensagem') && session('resultado') == true)
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script>
            $(document).ready(function(){
                showInfoModalSuccess('{{session('mensagem')}}');
            });
        </script>
    @endif
@endsection