@extends('templates.main', ['titulo' => "Alterar Serviço Agendado"])

@section('titulo')- Alterar servico Agendado @endsection

@section('conteudo')

    <form action="{{ route('servicoagendamentos.update', $servicoagendamento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
        
            <div class="col-5" >
                <div class="form-floating mb-3">
                    <select id="pet_id" name="pet_id" placeholder="Tex" class="form-control {{ $errors->has('pet_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O PET</option>
                        @foreach ($pets as $item) 
                            <option value="{{$item->id}}" @if($item->id == $servicoagendamento->pet_id) selected="true" @endif>
                                {{'PET '.$item->nome.' & TUTOR '.$item->cliente->name}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('pet_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('pet_id') }}
                        </div>
                    @endif
                    <label for="pet_id">Pet</label>
                </div>
            </div>

            <div class="col-4" >
                <div class="form-floating mb-3">
                    <select id="veterinario_id" name="veterinario_id" placeholder="Tex" class="form-control {{ $errors->has('veterinario_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O VETERINÁRIO</option>
                        @foreach ($veterinarios as $item) 
                            <option value="{{$item->id}}" @if($item->id == $servicoagendamento->veterinario_id) selected="true" @endif>
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('veterinario_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('veterinario_id') }}
                        </div>
                    @endif
                    <label for="veterinario_id">Veterinário</label>
                </div>
            </div>

            <div class="col-3" >
                <div class="form-floating mb-3">
                    <select id="servico_id" name="servico_id" placeholder="Tex" class="form-control {{ $errors->has('servico_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O servico ATUAL</option>
                        @foreach ($servicos as $item) 
                            <option value="{{$item->id}}" @if($item->id == $servicoagendamento->servico_id) selected="true" @endif>
                                {{$item->nome}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('servico_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('servico_id') }}
                        </div>
                    @endif
                    <label for="servico_id">Serviço</label>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-2" >
                <div class="form-floating mb-2">
                    <input 
                        type="date" 
                        class="form-control {{ $errors->has('dataServico') ? 'is-invalid' : '' }}" 
                        name="dataServico" 
                        placeholder="dataServico"
                        value="{{$servicoagendamento['data_servico']}}"
                        required
                    />
                    @if($errors->has('dataServico'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('dataServico') }}
                        </div>
                    @endif
                    <label for="dataServico">Data do Serviço</label>
                </div>
            </div>

            <div class="col-2" >
                <div class="form-floating mb-3">
                    <input 
                        type="time" 
                        class="form-control {{ $errors->has('horarioServico') ? 'is-invalid' : '' }}" 
                        name="horarioServico" 
                        placeholder="horarioServico"
                        value="{{$servicoagendamento['horario_servico']}}"
                        required
                    />
                    @if($errors->has('horarioServico'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('horarioServico') }}
                        </div>
                    @endif
                    <label for="horarioServico">Horário do Serviço</label>
                </div>
            </div>

            <div class="col-3" >
                <div class="form-floating mb-3">
                    <select id="status_id" name="status_id" placeholder="Tex" class="form-control {{ $errors->has('status_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O STATUS ATUAL</option>
                        @foreach ($statuses as $item) 
                            <option value="{{$item->id}}" @if($item->id == $servicoagendamento->status_id) selected="true" @endif>
                                {{$item->nome}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('status_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('status_id') }}
                        </div>
                    @endif
                    <label for="status_id">Status</label>
                </div>
            </div>
        </div>

        <hr>

        <h4>Relatório Médico</h4>


        <div class="row">
            <div class="col" >
                <textarea id="relatorio" class="form-control" name="relatorio" rows="8">@isset($servicoagendamento->relatorio){{$servicoagendamento->relatorio}}@else @endIf</textarea>
                
                <div class="form-floating mb-3"></div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a href="{{ route('servicoagendamentos.index') }}" class="btn btn-secondary btn-block align-content-center">
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
@endsection