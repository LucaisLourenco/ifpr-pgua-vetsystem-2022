@extends('templates.main', ['titulo' => "Alterar Pet"])

@section('titulo')- Alterar Pet @endsection

@section('conteudo')

    <form action="{{ route('pets.update', $pet) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input 
                        type="text" 
                        class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" 
                        name="nome" 
                        placeholder="Nome"
                        value="{{$pet->nome}}"
                        required
                    />
                    @if($errors->has('nome'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('nome') }}
                        </div>
                    @endif
                    <label for="nome">Nome do Pet</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-5" >
                <div class="form-floating mb-3">
                    <select id="cliente_id" name="cliente_id" placeholder="Tex" class="form-control {{ $errors->has('cliente_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O TUTOR</option>
                        @foreach ($clientes as $item) 
                            <option value="{{$item->id}}" @if($item->id == $pet->cliente_id) selected="true" @endif>
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('cliente_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('cliente_id') }}
                        </div>
                    @endif
                    <label for="cliente_id">Tutor</label>
                </div>
            </div>
   
            <div class="col-4" >
                <div class="form-floating mb-3">
                    <select id="sexo_id" name="sexo_id" placeholder="Tex" class="form-control {{ $errors->has('sexo_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O SEXO</option>
                        @foreach ($sexos as $item) 
                            <option value="{{$item->id}}" @if($item->id == $pet->sexo_id) selected="true" @endif>
                                {{$item->nome}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('sexo_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('sexo_id') }}
                        </div>
                    @endif
                    <label for="sexo_id">Sexo</label>
                </div>
            </div>

            <div class="col-3" >
                <div class="form-floating mb-3">
                    <input 
                        type="date" 
                        class="form-control {{ $errors->has('data_nascimento') ? 'is-invalid' : '' }}" 
                        name="data_nascimento" 
                        placeholder="Data de Nascimento"
                        value="{{$pet->data_nascimento}}"
                        required
                    />
                    @if($errors->has('data_nascimento'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('data_nascimento') }}
                        </div>
                    @endif
                    <label for="data_nascimento">Data de Nascimento do Pet</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6" >
                <div class="form-floating mb-3">
                    <select id="especie_id" name="especie_id" placeholder="Tex" class="form-control {{ $errors->has('especie_id') ? 'is-invalid' : '' }}" required>
                    <option value="">SELECIONE A ESPÉCIE</option>
                        @foreach ($especies as $item) 
                            <option value="{{$item->id}}" @if($item->id == $pet->raca->especie_id) selected="true" @endif>
                                {{$item->nome}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('especie_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('especie_id') }}
                        </div>
                    @endif
                    <label for="especie_id">Espécie</label>
                </div>
            </div>
            
            <div class="col-6" >
                <div class="form-floating mb-3">
                    <select id="raca_id" name="raca_id" placeholder="Tex" class="form-control {{ $errors->has('raca_id') ? 'is-invalid' : '' }}" required>
                        <option>SELECIONE A RACA</option>
                        @foreach ($especie->racas as $item) 
                            <option value="{{$item->id}}" @if($item->id == $pet->raca_id) selected="true" @endif>
                                {{$item->nome}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('raca_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('raca_id') }}
                        </div>
                    @endif
                    <label for="raca_id">Raça</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a href="{{ route('pets.show', $pet->id) }}" class="btn btn-secondary btn-block align-content-center">
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

    <!-- load jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- provide the csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
            $('#especie_id').change(function() {
                var especie_id = $('#especie_id').val();
                if (especie_id === "") {
                    $('#raca_id').empty();
                    $('#raca_id').append($('<option>', {value: null, text: 'SELECIONE A RACA'}));
                    $('#raca_id').attr('disabled','disabled')
                } else {
                    $.ajax({
                        url: '/selectRaca',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN, especie_id: especie_id},
                        dataType: 'json',
                        success: function (racas) { 
                            $('#raca_id').empty();
                            $('#raca_id').append($('<option>', {value: null, text: 'SELECIONE A RACA'}));
                            $.each( racas, function(a, b) {
                                $('#raca_id').append($('<option>', {value: b['id'], text: b['nome']}));
                                $('#raca_id').removeAttr('disabled');
                            });
                        },
                        
                        error:function(){
                            alert('Erro');
                        },
                    });
                }
            });
        });
    </script>

@endsection