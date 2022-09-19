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
                                <a href= "" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModalEndereco{{$item->id}}">                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
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
                <a href= "" class="btn btn-secondary text-white">
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
                        <th scope="col" class="d-none d-md-table-cell">CONTATO</th>
                        <th id="coluna-acoes-users-perfil" scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cliente->telefones as $item)
                        <tr>
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

    <!--Modal Editar Endereço-->
    <div class="modal fade" id="editModalEndereco{{$item->id}}" tabindex="-1" aria-labelledby="editModalEnderecoLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalEnderecoLabel">Editar Endereco</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('enderecos.update', $item['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <?php
                        use App\Models\Endereco;
                        $endereco = Endereco::find($item->id); 
                    ?>        
                    <div class="row">
                        <div class="col" >
                            <div class="form-floating mb-3">
                                <input 
                                    type="text" 
                                    class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" 
                                    name="nome" 
                                    placeholder="Nome"
                                    value="{{$endereco->nome}}"
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
                                    onkeydown="javascript: fMasc( this, mCEP );"
                                    placeholder="cep"
                                    value="{{$endereco->cep}}"
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
                                    value="{{$endereco->rua}}"
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
                                    value="{{$endereco->numero}}"
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
                                    value="{{$endereco->bairro}}"
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
                                    value="{{complemento}}"
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
                                    value="{{$endereco->cidade}}"
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
                                    value="{{$endereco->uf}}"
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
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary btn-block align-content-center" data-bs-dismiss="modal">
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
        </div>
    </div>
@endsection