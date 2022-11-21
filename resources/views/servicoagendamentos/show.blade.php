@extends('templates.main', ['titulo' => 'Serviço '.$servicoagendamento->pet->nome])

@section('titulo')- Serviço {{$servicoagendamento->pet->nome}} @endsection

@section('conteudo')

    <h3>Dados da Serviço</h3>

    <dl class="row">
        <dt class="col-sm-2">PET</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->pet->nome }}</dd>

        <dt class="col-sm-2">Tutor</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->pet->cliente->name }}</dd>

        <dt class="col-sm-2">Categoria</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->servico->nome }}</dd>

        <dt class="col-sm-2">Veterinário</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->veterinario->name }}</dd>

        <dt class="col-sm-2">Status</dt>
        <dd class="col-sm-10">{{ $servicoagendamento->status->nome }}</dd>
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
                    <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
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
    <div class="row">    
        <div class="col-12">   
            <a href="{{route('servicoagendamentos.index')}}" class="btn btn-primary text-white">Tela de Serviços
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-text-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
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