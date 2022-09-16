@extends('templates.main', ['titulo' => "Novo Endereço"])

@section('titulo') Endereços @endsection

@section('conteudo')

    <form action="{{ route('enderecos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col" >
                <div class="form-floating mb-3">
                    <input 
                        type="text" 
                        class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" 
                        name="nome" 
                        placeholder="Nome"
                        value="{{old('nome')}}"
                        required
                    />
                    @if($errors->has('nome'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('nome') }}
                        </div>
                    @endif
                    <label for="nome">Nome do Endereço</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2" >
                <div class="form-floating mb-3">
                    <input 
                        id="cep"
                        type="text" 
                        class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}" 
                        name="cep" 
                        placeholder="cep"
                        value="{{old('cep')}}"
                        required
                    />
                    @if($errors->has('cep'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('cep') }}
                        </div>
                    @endif
                    <label for="cep">Cep</label>
                </div>
            </div>
            <div class="col-8" >
                <div class="form-floating mb-3">
                    <input 
                        id="rua"
                        type="text" 
                        class="form-control {{ $errors->has('rua') ? 'is-invalid' : '' }}" 
                        name="rua" 
                        placeholder="rua"
                        value="{{old('rua')}}"
                        required
                    />
                    @if($errors->has('rua'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('rua') }}
                        </div>
                    @endif
                    <label for="rua">Rua</label>
                </div>
            </div>
            <div class="col-2" >
                <div class="form-floating mb-3">
                    <input 
                        id="numero"
                        type="number" 
                        class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" 
                        name="numero" 
                        placeholder="numero"
                        value="{{old('numero')}}"
                        required
                    />
                    @if($errors->has('numero'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('numero') }}
                        </div>
                    @endif
                    <label for="numero">Número</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3" >
                <div class="form-floating mb-3">
                    <input 
                        id="bairro"
                        type="text" 
                        class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" 
                        name="bairro" 
                        placeholder="bairro"
                        value="{{old('bairro')}}"
                        required
                    />
                    @if($errors->has('bairro'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('bairro') }}
                        </div>
                    @endif
                    <label for="bairro">Bairro</label>
                </div>
            </div>
            <div class="col-5" >
                <div class="form-floating mb-3">
                    <input 
                        id="complemento"
                        type="text" 
                        class="form-control {{ $errors->has('complemento') ? 'is-invalid' : '' }}" 
                        name="complemento" 
                        placeholder="complemento"
                        value="{{old('complemento')}}"
                    />
                    @if($errors->has('complemento'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('complemento') }}
                        </div>
                    @endif
                    <label for="complemento">Complemento</label>
                </div>
            </div>
            <div class="col-3" >
                <div class="form-floating mb-3">
                    <input 
                        id="cidade"
                        type="text" 
                        class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" 
                        name="cidade" 
                        placeholder="cidade"
                        value="{{old('cidade')}}"
                        required
                    />
                    @if($errors->has('cidade'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('cidade') }}
                        </div>
                    @endif
                    <label for="cidade">Cidade</label>
                </div>
            </div>
            <div class="col-1" >
                <div class="form-floating mb-3">
                    <input 
                        id="uf"
                        type="text" 
                        class="form-control {{ $errors->has('uf') ? 'is-invalid' : '' }}" 
                        name="uf" 
                        placeholder="uf"
                        value="{{old('uf')}}"
                        required
                    />
                    @if($errors->has('uf'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('uf') }}
                        </div>
                    @endif
                    <label for="uf">UF</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{route('enderecos.index')}}" class="btn btn-secondary btn-block align-content-center">
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

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script>

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#complemento").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#complemento").val(dados.complemento);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
@endsection