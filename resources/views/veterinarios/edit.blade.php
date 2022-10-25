@extends('templates.main', ['titulo' => "Alterar Veterinário"])

@section('titulo')- Alterar Veterinário @endsection

@section('conteudo')

    <form action="{{ route('veterinarios.update', $veterinario) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6" >
                <div class="form-floating mb-3">
                    <input 
                        type="text" 
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                        name="name" 
                        placeholder="name"
                        value="{{$veterinario->name}}"
                        required
                    />
                    @if($errors->has('name'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <label for="name">Nome do Veterinário</label>
                </div>
            </div>

            <div class="col-3" >
                <div class="form-floating mb-3">
                    <input 
                        type="text" 
                        class="form-control {{ $errors->has('crmv') ? 'is-invalid' : '' }}" 
                        name="crmv" 
                        onkeydown="javascript: fMasc( this, mCRMV );"
                        placeholder="crmv"
                        value="{{$veterinario->crmv}}"
                        required
                    />
                    @if($errors->has('crmv'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('crmv') }}
                        </div>
                    @endif
                    <label for="crmv">CRMV do Veterinário</label>
                </div>
            </div>

            <div class="col-3" >
                <div class="form-floating mb-3">
                    <input 
                        type="text" 
                        class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" 
                        name="cpf" 
                        onkeydown="javascript: fMasc( this, mCPF );"
                        placeholder="CPF"
                        value="{{$veterinario->cpf}}"
                        required
                    />
                    @if($errors->has('cpf'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('cpf') }}
                        </div>
                    @endif
                    <label for="cpf">CPF do Veterinário</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4" >
                <div class="form-floating mb-3">
                    <input 
                        type="email" 
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                        name="email" 
                        placeholder="E-mail"
                        value="{{$veterinario->email}}"
                        required
                    />
                    @if($errors->has('email'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <label for="email">E-mail do Veterinário</label>
                </div>
            </div>
            <div class="col-2" >
                <div class="form-floating mb-3">
                    <input 
                        type="date" 
                        class="form-control {{ $errors->has('data_nascimento') ? 'is-invalid' : '' }}" 
                        name="data_nascimento" 
                        placeholder="Data de Nascimento"
                        value="{{$veterinario->data_nascimento}}"
                        required
                    />
                    @if($errors->has('data_nascimento'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('data_nascimento') }}
                        </div>
                    @endif
                    <label for="data_nascimento">Data de Nascimento</label>
                </div>
            </div>
            <div class="col-3" >
                <div class="form-floating mb-3">
                    <select name="genero_id" class="form-control {{ $errors->has('genero_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE O GÊNERO</option>
                        @foreach ($generos as $item) 
                            <option value="{{$item->id}}"  @if($item->id == $veterinario->genero_id) selected="true" @endif>
                                {{$item->nome}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('genero_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('genero_id') }}
                        </div>
                    @endif
                    <label for="genero_id">Gênero</label>
                </div>
            </div>

            <div class="col-3" >
                <div class="form-floating mb-3">
                    <select name="especialidade_id" class="form-control {{ $errors->has('especialidade_id') ? 'is-invalid' : '' }}" required>
                    <option value="{{null}}">SELECIONE A ESPECIALIDADE</option>
                        @foreach ($especialidades as $item) 
                            <option value="{{$item->id}}"  @if($item->id == $veterinario->especialidade_id) selected="true" @endif>
                                {{$item->nome}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('especialidade_id'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('especialidade_id') }}
                        </div>
                    @endif
                    <label for="especialidade_id">Especialidade</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('veterinarios.show', $veterinario->id) }}" class="btn btn-secondary btn-block align-content-center">
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