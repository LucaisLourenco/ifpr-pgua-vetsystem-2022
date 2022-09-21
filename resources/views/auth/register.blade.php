
<form method="POST" action="{{ route('register') }}">
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

        <div class="mt-4"> 
            <select name="role_id" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"> 
                @foreach($roles as $item) 
                    <option value="{{$item->id}}"> 
                        {{$item->nome}} 
                    </option> 
                @endforeach 
            </select> 
        </div>

        <button class="ml-4" type="submit">
            {{ __('Register') }}
        </button>
    </div>
</form>

