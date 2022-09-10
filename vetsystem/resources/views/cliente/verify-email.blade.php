<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <h2>Cliente</h2>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('cliente.verification.send') }}">
                {{ csrf_field() }}

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('cliente.logout') }}">
                {{ csrf_field() }}

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>

@extends('cliente.logintemplate', ['titulo' => "Validar E-mail Cliente"])

@section('conteudo')
    <form method="POST" action="{{ route('cliente.verification.send') }}">
        {{ csrf_field() }}
        <span class="login100-form-title">
            Validar E-mail Cliente
        </span>

        @if (session('status') == 'verification-link-sent')
            <div class="mensagem-true">
                Seu E-mail de verificação foi enviado com sucesso!
            </div>
        @endif
                
        <div class="container-login100-form-btn">
            <button type="submit" value="enviar" class="login100-form-btncliente">
                Enviar Verificação de E-mail
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
            <button type="submit" value="logout" class="login100-form-btncliente">
                Logout
            </button>
        </div>
    </form>


@endsection