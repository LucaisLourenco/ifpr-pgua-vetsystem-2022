@extends('cliente.logintemplate')

@section('conteudo')


            <form method="POST" action="{{ route('cliente.verification.send') }}">
                {{ csrf_field() }}
                <span class="login100-form-title">
                    Verificar E-mail
                </span>
                                
                    <button type="submit" value="redefinir" class="login100-form-btncliente">
                        Reenviar E-mail de Validação
                    </button>
            </form>

            <form method="POST" action="{{ route('cliente.logout') }}">
                {{ csrf_field() }}
                <span class="login100-form-title">
                    Fazer Logout
                </span>

                    <button type="submit" value="logout" class="login100-form-btncliente">
                        Desconectar
                    </button>
            </form>

            
@endsection
