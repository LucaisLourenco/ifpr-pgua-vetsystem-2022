@extends('templatescliente.main', ['titulo' => "Seu usuário ainda não foi verificado."])

@section('conteudo')
    <form method="POST" action="{{ route('cliente.verification.send') }}">
        {{ csrf_field() }}
       
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-justify">Verificar E-mail</p>
                    <button type="submit" value="enviar" class="btn btn-secondary btn-block align-content-center">
                        Enviar E-mail de Verificação
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
