@extends('veterinario.logintemplate')

@section('conteudo')
    <form method="POST" action="{{ route('veterinario.password.confirm') }}">
            {{ csrf_field() }}
        <span class="login100-form-title">
            Confirmar Senha Veterinário
        </span>

        <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input name="password" type="password" class="input100 {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Senha" required>
            @if($errors->has('password'))
                <div class='invalid-feedback text-center'>
                    {{ $errors->first('password') }}
                </div>
            @endif
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>
                        
        <div class="container-login100-form-btn">
            <button type="submit" value="redefinir" class="login100-form-btn">
                Confirmar Senha
            </button>
        </div>

        <div class="text-center p-t-136">
            <a class="txt2" href="#">
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
@endsection

