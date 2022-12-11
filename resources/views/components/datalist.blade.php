    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table align-middle caption-top table-striped">
                    <caption>Tabela de <b>{{$title}}</b></caption>
                    <thead>
                        <tr>
                            @php $cont=0; @endphp
                            @foreach ($header as $item)
                                @if($hide[$cont])
                                    <th scope="col" class="d-none d-md-table-cell">{{ $item }}</th>
                                @else
                                    @if($route != "consultaagendamentos" && $route != "servicoagendamentos")
                                        <th id="coluna-acoes" scope="col">{{ $item }}</th>
                                    @else
                                        <th id="coluna-acoes-users" scope="col">{{ $item }}</th>
                                    @endif
                                @endif
                                @php $cont++; @endphp
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                
                                @if($route != "consultaagendamentos" && $route != "servicoagendamentos")
                                    <td>{{ $item['nome'] }}</td>
                                @elseif($route == "consultaagendamentos")
                                    <td>{{$item->veterinario['name']}}</td>
                                    <td>{{$item->pet['nome'].' & '.$item->pet->cliente->name}}</td>
                                    <td>{{$item['data_consulta']}}</td>
                                    <td>{{$item['horario_consulta']}}</td>
                                    <td>{{$item->status['nome']}}</td>
                                @else
                                    <td>{{$item->veterinario['name']}}</td>
                                    <td>{{$item->pet['nome'].' & '.$item->pet->cliente->name}}</td>
                                    <td>{{$item->servico['nome']}}</td>
                                    <td>{{$item['data_servico']}}</td>
                                    <td>{{$item['horario_servico']}}</td>
                                    <td>{{$item->status['nome']}}</td>
                                @endif

                                @if($route == "racas")
                                    <td>{{$item->especie['nome']}}</td>

                                @elseif($route == "pets")
                                    <td>{{$item->cliente['name']}}</td>
                                    <td>{{$item->raca['nome']}}</td>
                                    <td>{{$item->raca->especie['nome']}}</td>

                                    @if ($item['ativo'] == 1)
                                        <td>ATIVO</td>
                                    @else
                                        <td>DESABILITADO</td>
                                    @endif

                                @elseif($route == "servicos")
                                    <td>R$ {{ $item['valor'] }}</td>
                                    <td>{{ $item['descricao'] }}</td>
                                @endif

                                <td>
                                    @if($route != "consultaagendamentos" && $route != "servicoagendamentos")
                                        <a href= "{{ route($route.'.edit', $item['id']) }}" class="btn btn-success">Editar
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                                <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                            </svg>
                                        </a>
                                        
                                        <a nohref style="cursor:pointer" onclick="showRemoveModal('{{ $item['id'] }}', '{{ $item['nome'] }}')" class="btn btn-danger">Deletar
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </a>
                                    @else
                                        <a href= "{{ route($route.'.show', $item) }}" class="btn btn-primary">Vizualizar
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                                <form action="{{ route($route.'.destroy', $item['id']) }}" method="POST" id="form_{{$item['id']}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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