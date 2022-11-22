@extends('templates.main', ['titulo' => 'Serviço '.$servicoagendamento->pet->nome])

@section('titulo')- Serviço {{$servicoagendamento->pet->nome}} @endsection

@section('conteudo')

    <h3>Dados do Serviço</h3>

    <dl class="row">
        <dt class="col-sm-2">PET</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->pet->nome }}</dd>

        <dt class="col-sm-2">Tutor</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->pet->cliente->name }}</dd>

        <dt class="col-sm-2">Categoria</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->servico->nome }}</dd>

        <dt class="col-sm-2">Veterinário</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->veterinario->name }}</dd>

        <dt class="col-sm-2">Data e Horário</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->data_servico.' '.$servicoagendamento->horario_servico }}</dd>

        <dt class="col-sm-2">Status</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->status->nome }}</dd>

        <dt class="col-sm-2">Valor da Serviço</dt>
        <dd class="col-sm-10">{{ 'R$ '.$servicoagendamento->servico->valor }}</dd>
    </dl>

    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary text-white" href= "{{ route('servicoagendamentos.edit', $servicoagendamento) }}">Alterar Dados
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-hearts" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.931.481c1.627-1.671 5.692 1.254 0 5.015-5.692-3.76-1.626-6.686 0-5.015Zm6.84 1.794c1.084-1.114 3.795.836 0 3.343-3.795-2.507-1.084-4.457 0-3.343ZM7.84 7.642c2.71-2.786 9.486 2.09 0 8.358-9.487-6.268-2.71-11.144 0-8.358Z"/>
                </svg>
            </a>

            <a href="{{ route('pets.show', $servicoagendamento->pet) }}" class="btn btn-success text-white">Vizualizar Pet
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-heart" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                </svg>
            </a>

            <a nohref onclick="showRemoveModal('{{ $servicoagendamento['id'] }}', '{{ $servicoagendamento['id'].' - servico de '.$servicoagendamento->pet->nome }}')" class="btn btn-danger">Remover Serviço
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
            </a>
        </div>

        <form action="{{ route('servicoagendamentos.destroy', $servicoagendamento['id']) }}" method="POST" id="form_{{$servicoagendamento['id']}}">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <hr>
    <h3>Relatório do Serviço</h3>
    <div class="row">
        <div class="col" >
            <textarea id="relatorio" class="form-control" name="relatorio" rows="8" disabled>@isset($servicoagendamento->relatorio){{$servicoagendamento->relatorio}}@else @endIf</textarea>
            
            <div class="form-floating mb-3"></div>
        </div>
    </div>
   
    <hr>
    <div class="row">    
        <div class="col-12">   
            <a href="{{ route('servicoagendamentos.index') }}" class="btn btn-secondary btn-block align-content-center">Tela de Serviços
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
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