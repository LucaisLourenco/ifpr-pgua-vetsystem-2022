@extends('templates.main', ['titulo' => $pet->nome])

@section('titulo')- Pet @endsection

@section('conteudo')

    <h3>Dados Pet</h3>

    <dl class="row">
        <dt class="col-sm-2">Pet</dt>
        <dd class="col-sm-10">{{ $pet->nome }}</dd>
        
        <dt class="col-sm-2">Tutor</dt>
        <dd class="col-sm-10">{{ $pet->cliente->name }}</dd>

        <dt class="col-sm-2">Espécie</dt>
        <dd class="col-sm-10">{{ $pet->raca->especie->nome }}</dd>

        <dt class="col-sm-2">Raça</dt>
        <dd class="col-sm-10">{{ $pet->raca->nome }}</dd>

        <dt class="col-sm-2">Sexo</dt>
        <dd class="col-sm-10">{{ $pet->sexo->nome }}</dd>

        <dt class="col-sm-2">Status</dt>
        
        @if($pet->ativo == 1)
            <dd class="col-sm-10">Pet ativo</dd>
        @else
            <dd class="col-sm-10">Pet bloqueado</dd>
        @endif
    </dl>

    <div class="row">
        <!--EDITAR DADOS CADASTRAIS-->
        <div class="col-2">
            <a href= "{{ route('pets.edit', $pet) }}">Alterar Dados</a>
        </div>
    </div>

    <hr>
    <div class="row">    
        <div class="col-12">   
            <table class="table align-middle caption-top table-striped">
                <caption>Consultas <b>Pet</b></caption>
                <thead>
                    <tr>
                        
                    </tr>
                </thead>
                <tbody>
               
                </tbody>
            </table>
            <div class="col d-flex justify-content-end">
                <a href=" " class="btn btn-secondary text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            </div> 
        </div>
    </div>

    <hr>
    <div class="row">    
        <div class="col-12">   
            <a href="{{route('pets.index')}}" class="btn btn-primary text-white">Tela Pets
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list-columns" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 0 .5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2A.5.5 0 0 1 .5 2h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2A.5.5 0 0 1 .5 4h10a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2A.5.5 0 0 1 .5 6h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2A.5.5 0 0 1 .5 8h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Z"/>
                </svg>
            </a>

            <a href="{{ route('clientes.show', $pet->cliente) }}" class="btn btn-danger text-white">Meu Tutor
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-heart" viewBox="0 0 16 16">
                    <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
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