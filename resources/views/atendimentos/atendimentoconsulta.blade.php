@extends('templatesveterinario.main', ['titulo' => 'Consulta '.$consultaAgendamento->pet->nome])

@section('titulo')- Atendimento Consulta @endsection

@section('conteudo')
    
    <div class="row">
        <div class="col-6">
            <h3>Dados Pet</h3>

            <dl class="row">
                <dt class="col-sm-2">Pet</dt>
                <dd class="col-sm-10">{{ $consultaAgendamento->pet->nome }}</dd>

                @isset($consultaAgendamento->pet->data_nascimento)
                    <dt class="col-sm-2">Nascimento</dt>
                    <dd class="col-sm-10">{{ $consultaAgendamento->pet->data_nascimento }}</dd>
                @endif
                
                <dt class="col-sm-2">Tutor</dt>
                <dd class="col-sm-10">{{ $consultaAgendamento->pet->cliente->name }}</dd>

                <dt class="col-sm-2">Espécie</dt>
                <dd class="col-sm-10">{{ $consultaAgendamento->pet->raca->especie->nome }}</dd>

                <dt class="col-sm-2">Raça</dt>
                <dd class="col-sm-10">{{ $consultaAgendamento->pet->raca->nome }}</dd>

                <dt class="col-sm-2">Sexo</dt>
                <dd class="col-sm-10">{{ $consultaAgendamento->pet->sexo->nome }}</dd>
            </dl>
        </div>

        <div class="col-6">
            <h3>Dados da Consulta</h3>

            <dl class="row">
                <dt class="col-sm-4">Data e Horário</dt>
                <dd class="col-sm-8">{{ $consultaAgendamento->data_consulta.' '.$consultaAgendamento->horario_consulta }}</dd>

                <dt class="col-sm-4">Valor da Consulta</dt>
                <dd class="col-sm-8">{{ 'R$ '.$consultaAgendamento->valor }}</dd>
            </dl>
        </div>
    </div>

    <hr>
    <div class="row">    
        <div class="col-6">   
            <div class="table-responsive">
                <table class="table align-middle caption-top table-striped">
                    <caption>Histórico de <b>Pesos</b></caption>
                    <thead>
                        <tr>
                            <th scope="col" class="d-none d-md-table-cell">PESO</th>
                            <th scope="col" class="d-none d-md-table-cell">DATA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultaAgendamento->pet->pesos as $item)
                            <tr>
                                <td>{{ number_format($item->peso, 3) }} gramas</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col d-flex justify-content-end">
                    <a href="{{ route('atendimentos.novoPeso', $consultaAgendamento) }}" class="btn btn-secondary text-white">Nova Pesagem
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                    </a>
                </div>  
            </div>
        </div>

        <div class="col-6"> 
            <div class="table-responsive">
    
                <table class="table align-middle caption-top table-striped">
                    <caption>Observações <b>Pet</b></caption>
                    <thead>
                        <tr>
                            <th scope="col" class="d-none d-md-table-cell">TIPO</th>
                            <th scope="col" class="d-none d-md-table-cell">VETERINÁRIO</th>
                            <th scope="col" class="d-none d-md-table-cell">DATA</th>
                            <th scope="col" class="d-none d-md-table-cell">DETALHES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultaAgendamento->pet->obs as $item)
                            <tr>
                                <td>{{ $item->tipo }}</td>
                                <td> @isset($item->veterinario->name) {{ $item->veterinario->name }} @endisset</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a nohref onclick="showInfoModal('{{ $item['descricao'] }}')" class="btn btn-primary">
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
                    <a href="{{ route('atendimentos.novaObservacao', $consultaAgendamento) }}" class="btn btn-secondary text-white">Nova Observação
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                    </a>
                </div>  
            </div>
        </div>
    </div>

    <form action="{{ route('atendimentos.alterarConsulta', $consultaAgendamento) }}" method="POST">
        @csrf
        @method('PUT')
        
        <hr>
        <h4>Relatório Médico</h4>

        <div class="row">
            <div class="col" >
                <textarea id="relatorio" class="form-control" name="relatorio" rows="8">@isset($consultaAgendamento->relatorio){{$consultaAgendamento->relatorio}}@else @endIf</textarea>
                
                <div class="form-floating mb-3"></div>
            </div>
        </div>

        <div class="row">    
            <div class="col-4" >
                <div class="form-floating mb-3">
                    <select id="status_id" name="status_id" placeholder="Tex" class="form-control {{ $errors->has('status_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O STATUS ATUAL</option>
                        @foreach ($statuses as $item) 
                            <option value="{{$item->id}}" @if($item->id == $consultaAgendamento->status_id) selected="true" @endif>
                                {{$item->nome}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('status_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('status_id') }}
                        </div>
                    @endif
                    <label for="status_id">Situação do Atendimento</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a href="{{ route('atendimentos.index', $consultaAgendamento->veterinario) }}" class="btn btn-secondary btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    &nbsp; Voltar
                </a>
                <button class="btn btn-success btn-block align-content-center" type="submit" id="bt_salvar">
                    <b>Confirmar</b>&nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </button>
            </div>
        </div>
    </form>

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