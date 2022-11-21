@extends('templates.main', ['titulo' => $user->name])

@section('titulo')- Funcionário @endsection

@section('conteudo')

    <h3>Dados Cadastrais</h3>

    <dl class="row">
        <dt class="col-sm-2">Funcionário</dt>
        <dd class="col-sm-10">{{ $user->name }}</dd>
        
        <dt class="col-sm-2">CPF</dt>
        <dd class="col-sm-10">{{ $user->cpf }}</dd>

        <dt class="col-sm-2">E-mail</dt>
        <dd class="col-sm-10">{{ $user->email }}</dd>

        <dt class="col-sm-2">Gênero</dt>
        <dd class="col-sm-10">{{ $user->genero->nome }}</dd>

        <dt class="col-sm-2">Função</dt>
        <dd class="col-sm-10">{{ $user->role->nome }}</dd>

        <dt class="col-sm-2">Data de Nascimento</dt>
        <dd class="col-sm-10">{{ $user->data_nascimento }}</dd>

        <dt class="col-sm-2">Status</dt>
        
        @if($user->ativo == 1)
            <dd class="col-sm-10">Funcionário ativo</dd>
        @else
            <dd class="col-sm-10">Funcionário bloqueado</dd>
        @endif
    </dl>

    <div class="row">
        <!--EDITAR DADOS CADASTRAIS-->
        <div class="col-12">
            <a class="btn btn-primary text-white" href= "{{ route('users.edit', $user) }}">Alterar Dados
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-hearts" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.931.481c1.627-1.671 5.692 1.254 0 5.015-5.692-3.76-1.626-6.686 0-5.015Zm6.84 1.794c1.084-1.114 3.795.836 0 3.343-3.795-2.507-1.084-4.457 0-3.343ZM7.84 7.642c2.71-2.786 9.486 2.09 0 8.358-9.487-6.268-2.71-11.144 0-8.358Z"/>
                </svg>
            </a>

            <!--REDEFINIR SENHA user-->
            <a href="{{ route('users.redefinirSenha', $user) }}" class="btn btn-success">Redefinir Senha
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                </svg>
            </a>

            <!--REMOVER user-->
            <a nohref onclick="showRemoveModal('{{ $user['id'] }}', '{{ $user['name'] }}')" class="btn btn-danger">Remover Funcionário
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
            </a>
        </div>

        <form action="{{ route('users.destroy', $user['id']) }}" method="POST" id="form_{{$user['id']}}">
            @csrf
            @method('DELETE')
        </form>
    </div><hr>

    <!--TABELA DE ENDERECOS E TELEFONES-->
    <div class="row">  
        
        <!--ENDERECOS-->
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
                    @foreach ($user->enderecos as $item)
                        <tr>
                            <td>{{ $item['nome'] }}</td>
                            <td>{{ $item['rua'] }}</td>
                            <td>{{ $item['bairro'] }}</td>
                            <td>
                                <!--ENDERECOS EDIT-->
                                <a href= "{{ route('userEnderecos.edit', $item) }}" class="btn btn-success">                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                    </svg>
                                </a>

                                <!--ENDERECOS SHOW-->
                                <a nohref onclick="showInfoModalEndereco('{{ $item['nome'] }}','{{ $item['cep'] }}','{{ $item['rua'] }}',
                                        '{{ $item['numero'] }}','{{ $item['complemento'] }}','{{ $item['bairro'] }}','{{ $item['cidade'] }}',
                                            '{{ $item['uf'] }}')" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </a>

                                <!--ENDERECOS DESTROY-->
                                <a nohref onclick="showRemoveModalEndereco('{{ $item['id'] }}', '{{ $item['nome'] }}')" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                            </td>
                            <form action="{{ route('userEnderecos.destroy', $item['id']) }}" method="POST" id="endereco_{{$item['id']}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!--ENDERECOS CADASTRAR-->
            <div class="col d-flex justify-content-end">
                <a href="{{ route('userEnderecos.newEndereco', $user) }}" class="btn btn-secondary">Novo Endereço
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            </div> 
        </div>

        <!--TELEFONES-->
        <div class="col-6">    
            <table class="table align-middle caption-top table-striped">
                <caption>Lista de <b>Telefones</b></caption>
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">TIPO DE TELEFONE</th>
                        <th scope="col" class="d-none d-md-table-cell">NÚMERO</th>
                        <th id="coluna-acoes-users-perfil" scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->telefones as $item)
                        <tr>
                            <td>{{ $item['nome'] }}</td>
                            <td>{{ $item['numero'] }}</td>
                            <td>
                                <!--TELEFONES EDIT-->
                                <a href="{{ route('userTelefones.edit', $item) }}" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                    </svg>
                                </a>

                                <!--TELEFONES DESTROY-->
                                <a nohref onclick="showRemoveModalTelefone('{{ $item['id'] }}', '{{ $item['numero'] }}')" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                            </td>
                            <form action="{{ route('userTelefones.destroy', $item['id']) }}" method="POST" id="telefone_{{$item['id']}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!--TELEFONES CADASTRAR-->
            <div class="col d-flex justify-content-end">
                <a href="{{ route('userTelefones.newTelefone', $user) }}" class="btn btn-secondary text-white">Novo Telefone
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