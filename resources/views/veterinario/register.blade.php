<form method="POST" action="{{ route('veterinario.register') }}">
    {{ csrf_field() }}
    <div class="container">
        <div>
            <label for="name">Nome</label>
            <input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus />
        </div>

        <div class="mt-4">
            <label for="email">Email</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" required />            
        </div>

        <div class="mt-4">
            <label for="password">Senha</label>
            <input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation">Confirme a senha</label>
            <input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />
        </div>

            <button class="ml-4" type="submit">
                {{ ('Register') }}
            </button>
    </div>
</form>
