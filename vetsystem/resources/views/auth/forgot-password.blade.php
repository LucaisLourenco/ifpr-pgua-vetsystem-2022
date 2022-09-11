@extends('auth.logintemplate')

@section('conteudo')
    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <span class="login100-form-title">
            Redefir Senha Cliente
        </span>

        @if (session('status') == 'link-enviado')
            <div class="mensagem-true">
                Seu E-mail de redefinição foi enviado!
            </div>
        @endif

        @if (session('status') == 'link-nao-enviado-aguarde')
            <div class="mensagem-false">
                E-mail não enviado, aguarde!
            </div>
        @endif
        
        @if (session('status') == 'link-nao-enviado')
            <div class="mensagem-false">
                O E-mail informado não foi encontrado!
            </div>
        @endif

        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input name="email" type="email" value="{{ old('email') }}" class="input100" placeholder="Email" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>
                        
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
@endsection

