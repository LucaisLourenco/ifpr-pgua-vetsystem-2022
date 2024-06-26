@extends('templates.main', ['titulo' => $pet->nome])

@section('titulo')- Pet @endsection

@section('conteudo')

    <h3>Dados Pet</h3>

    <dl class="row">
        <dt class="col-sm-2">Pet</dt>
        <dd class="col-sm-10">{{ $pet->nome }}</dd>

        @isset($pet->data_nascimento)
            <dt class="col-sm-2">Nascimento</dt>
            <dd class="col-sm-10">{{ $pet->data_nascimento }}</dd>
        @endif
        
        <dt class="col-sm-2">Tutor</dt>
        <dd class="col-sm-10">{{ $pet->cliente->name }}</dd>

        <dt class="col-sm-2">Espécie</dt>
        <dd class="col-sm-10">{{ $pet->raca->especie->nome }}</dd>

        <dt class="col-sm-2">Raça</dt>
        <dd class="col-sm-10">{{ $pet->raca->nome }}</dd>

        <dt class="col-sm-2">Sexo</dt>
        <dd class="col-sm-10">{{ $pet->sexo->nome }}</dd>

        <dt class="col-sm-2">Status</dt>
        
        @if($pet->ativo == 1)
            <dd class="col-sm-10">Pet ativo</dd>
        @else
            <dd class="col-sm-10">Pet bloqueado</dd>
        @endif
    </dl>

    <div class="row">
        <!--EDITAR DADOS CADASTRAIS-->
        <div class="col">
            <a class="btn btn-primary text-white" href= "{{ route('pets.edit', $pet) }}">Alterar Dados
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-hearts" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.931.481c1.627-1.671 5.692 1.254 0 5.015-5.692-3.76-1.626-6.686 0-5.015Zm6.84 1.794c1.084-1.114 3.795.836 0 3.343-3.795-2.507-1.084-4.457 0-3.343ZM7.84 7.642c2.71-2.786 9.486 2.09 0 8.358-9.487-6.268-2.71-11.144 0-8.358Z"/>
                </svg>
            </a>

            <!--REMOVER PET-->
            <a nohref onclick="showRemoveModalPet('{{ $pet['id'] }}', '{{ $pet['nome'] }}')" class="btn btn-danger">Remover Pet
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
            </a>
        </div>

        <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" id="pet_{{$pet['id']}}">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <hr>
    <div class="row">    
        <div class="col-6">   
            <table class="table align-middle caption-top table-striped">
                <caption>Histórico de <b>Pesos</b></caption>
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">PESO</th>
                        <th scope="col" class="d-none d-md-table-cell">DATA</th>
                        <th id="coluna-acoes-users-perfil" scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pet->pesos as $item)
                        <tr>
                            <td>{{ number_format($item->peso, 3) }} gramas</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <!--PESOS EDIT-->
                                <a href="{{ route('pesos.edit', $item) }}" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                    </svg>
                                </a>

                                <!--PESOS DESTROY-->
                                <a nohref style="cursor:pointer" onclick="showRemoveModal('{{ $item['id'] }}', '{{ $item['peso'] }}')" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                            </td>
                            <form action="{{ route('pesos.destroy', $item['id']) }}" method="POST" id="form_{{$item['id']}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col d-flex justify-content-end">
                <a href="{{ route('pesos.newPeso', $pet) }}" class="btn btn-secondary text-white">Nova Pesagem
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            </div> 
        </div>

        <div class="col-6">   
            <table class="table align-middle caption-top table-striped">
                <caption>Observações <b>Pet</b></caption>
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">TIPO</th>
                        <th scope="col" class="d-none d-md-table-cell">VETERINÁRIO</th>
                        <th scope="col" class="d-none d-md-table-cell">DATA</th>
                        <th id="coluna-acoes-users-perfil-enderecos" scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pet->obs as $item)
                        <tr>
                            <td>{{ $item->tipo }}</td>
                            <td> @isset($item->veterinario->name) {{ $item->veterinario->name }} @endisset</td>
                            <td>{{ $item->created_at }}</td>
                            <td>

                            <a href="{{ route('petobservacaos.edit', $item) }}" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                </svg>
                            </a>

                            <a nohref onclick="showInfoModal('{{ $item['descricao'] }}')" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </svg>
                            </a>
                            
                            <a nohref style="cursor:pointer" onclick="showRemoveModalForm2('{{ $item['id'] }}', '{{ $item['tipo'] }}')" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </a>
                        </tr>
                        <form action="{{ route('petobservacaos.destroy', $item['id']) }}" method="POST" id="form2_{{$item['id']}}">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach
                </tbody>
            </table>
            <div class="col d-flex justify-content-end">
                <a href="{{ route('petobservacaos.newObservacao', $pet) }}" class="btn btn-secondary text-white">Nova Observação
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            </div> 
        </div>
    </div>

    <hr>
    <div class="row">    
        <div class="col-12">   
            <table class="table align-middle caption-top table-striped">
                <caption>Consultas <b>Pet</b></caption>
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">VETERINÁRIO</th>
                        <th scope="col" class="d-none d-md-table-cell">DATA</th>
                        <th scope="col" class="d-none d-md-table-cell">HORÁRIO</th>
                        <th scope="col" class="d-none d-md-table-cell">STATUS</th>
                        <th id="coluna-acoes-users" scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultas as $item)
                        <tr>
                            <td>{{$item->veterinario['name']}}</td>
                            <td>{{$item['data_consulta']}}</td>
                            <td>{{$item['horario_consulta']}}</td>
                            <td>{{$item->status['nome']}}</td>
                            <td>
                                <a href= "{{ route('consultaagendamentos.show', $item) }}" class="btn btn-primary">Vizualizar
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col d-flex justify-content-end">
                <a href=" " class="btn btn-secondary text-white">Novo Agendamento
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            </div> 
        </div>
    </div>

    <hr>
    <div class="row">    
        <div class="col-12">   
            <table class="table align-middle caption-top table-striped">
                <caption>Serviços <b>Pet</b></caption>
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">VETERINÁRIO</th>
                        <th scope="col" class="d-none d-md-table-cell">CATEGORIA</th>
                        <th scope="col" class="d-none d-md-table-cell">DATA</th>
                        <th scope="col" class="d-none d-md-table-cell">HORÁRIO</th>
                        <th scope="col" class="d-none d-md-table-cell">STATUS</th>
                        <th id="coluna-acoes-users" scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicos as $item)
                        <tr>
                            <td>{{$item->veterinario['name']}}</td>
                            <td>{{$item->servico->nome}}</td>
                            <td>{{$item['data_servico']}}</td>
                            <td>{{$item['horario_servico']}}</td>
                            <td>{{$item->status['nome']}}</td>
                            <td>
                                <a href= "{{ route('servicoagendamentos.show', $item) }}" class="btn btn-primary">Vizualizar
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col d-flex justify-content-end">
                <a href=" " class="btn btn-secondary text-white">Novo Agendamento
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            </div> 
        </div>
    </div>

    <hr>
    <div class="row">    
        <div class="col-12">   
            <a href="{{route('pets.index')}}" class="btn btn-primary text-white">Tela Pets
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-text-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </a>

            <a href="{{ route('clientes.show', $pet->cliente) }}" class="btn btn-danger text-white">Meu Tutor
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-heart" viewBox="0 0 16 16">
                    <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
                </svg>
            </a>
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