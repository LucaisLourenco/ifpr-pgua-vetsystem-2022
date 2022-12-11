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
                                    <th id="coluna-acoes-users" scope="col">{{ $item }}</th>
                                @endif
                                @php $cont++; @endphp
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['name'] }}</td>

                                @if ($route == 'clientes')    
                                    <td>{{ $item['cpf'] }}</td> 
                                @elseif ($route == 'users')
                                    <td>{{ $item->role['nome'] }}</td> 
                                @else
                                    <td>{{ $item['crmv'] }}</td> 
                                @endif

                                <td>{{ $item['email'] }}</td> 
                                @if($item->ativo == 1)
                                    <td>ATIVO</td>
                                @else
                                    <td>INATIVO</td>
                                @endif
                                <td>
                                    <a href= "{{ route($route.'.show', $item) }}" class="btn btn-primary">Vizualizar
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