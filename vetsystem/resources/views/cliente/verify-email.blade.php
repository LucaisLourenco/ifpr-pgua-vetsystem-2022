@extends('cliente.logintemplate')

@section('conteudo')
    <form method="POST" action="{{ route('cliente.verification.send') }}">
        {{ csrf_field() }}
        <span class="login100-form-title">
            Verificar E-mail
        </span>
                        
        <div class="container-login100-form-btn">
            <button type="submit" value="redefinir" class="login100-form-btngestao">
                Redefinir Senha
            </button>
        </div>

        <div class="text-center p-t-136">
            <a class="txt2" href="#">
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>

    <form method="POST" action="{{ route('cliente.logout') }}">
        {{ csrf_field() }}

        <div class="container-login100-form-btn">
            <button type="submit" value="logout" class="login100-form-btngestao">
                Desconectar
            </button>
        </div>

        <div class="text-center p-t-136">
            <a class="txt2" href="#">
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
@endsection
