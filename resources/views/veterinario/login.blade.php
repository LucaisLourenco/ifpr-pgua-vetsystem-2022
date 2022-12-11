@extends('veterinario.logintemplate')

@section('conteudo')
    <form method="POST" action="{{ route('veterinario.login') }}">
        {{ csrf_field() }}
        <span class="login100-form-title">
            Login Veterinário
        </span>

        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input name="email" type="email" value="{{ old('email') }}" class="input100 {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Email" required>
            @if($errors->has('email'))
                <div class='invalid-feedback text-center'>
                    {{ $errors->first('email') }}
                </div>
            @endif
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input name="password" type="password" class="input100 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Senha" required>
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
            <button type="submit" value="login" class="login100-form-btn">
                Login
            </button>
        </div>

        <div class="text-center p-t-12">
            @if (Route::has('password.request'))
                <span class="txt1">
                    Esqueceu sua
                </span>
                <a class="txt2" href="{{ route('veterinario.password.request') }}">
                    Palavra-chave?
                </a>
            @endif
        </div>
    </form>
@endsection