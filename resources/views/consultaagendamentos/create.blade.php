@extends('templates.main', ['titulo' => "Novo Serviço"])

@section('titulo')- Cadastrar Serviço @endsection

@section('conteudo')

    <form action="{{ route('consultaagendamentos.store') }}" method="POST">
        @csrf

        <div class="row">
        
            <div class="col-5" >
                <div class="form-floating mb-3">
                    <select id="pet_id" name="pet_id" placeholder="Tex" class="form-control {{ $errors->has('pet_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O PET</option>
                        @foreach ($pets as $item) 
                            <option value="{{$item->id}}">
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

            <div class="col-5" >
                <div class="form-floating mb-3">
                    <select id="veterinario_id" name="veterinario_id" placeholder="Tex" class="form-control {{ $errors->has('veterinario_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O VETERINÁRIO</option>
                        @foreach ($veterinarios as $item) 
                            <option value="{{$item->id}}">
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

            <div class="col-2" >
                <div class="form-floating mb-3">
                    <input 
                        type="text" 
                        class="form-control {{ $errors->has('valor') ? 'is-invalid' : '' }}" 
                        name="valor" 
                        placeholder="valor"
                        value="{{old('valor')}}"
                        required
                    />
                    @if($errors->has('valor'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('valor') }}
                        </div>
                    @endif
                    <label for="valor">Valor</label>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-2" >
                <div class="form-floating mb-2">
                    <input 
                        type="date" 
                        class="form-control {{ $errors->has('dataConsulta') ? 'is-invalid' : '' }}" 
                        name="dataConsulta" 
                        placeholder="dataConsulta"
                        value="{{old('dataConsulta')}}"
                        required
                    />
                    @if($errors->has('dataConsulta'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('dataConsulta') }}
                        </div>
                    @endif
                    <label for="dataConsulta">Data da consulta</label>
                </div>
            </div>

            <div class="col-2" >
                <div class="form-floating mb-3">
                    <input 
                        type="time" 
                        class="form-control {{ $errors->has('horarioConsulta') ? 'is-invalid' : '' }}" 
                        name="horarioConsulta" 
                        placeholder="horarioConsulta"
                        value="{{old('horarioConsulta')}}"
                        required
                    />
                    @if($errors->has('horarioConsulta'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('horarioConsulta') }}
                        </div>
                    @endif
                    <label for="horarioConsulta">Horário da consulta</label>
                </div>
            </div>
        </div>
     
        <div class="row">
            <div class="col">
                <a href="{{ route('consultaagendamentos.index') }}" class="btn btn-secondary btn-block align-content-center">
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