
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div>
                <label for="name" :value="__('Name')" />

                <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <label for="email" :value="__('Email')" />

                <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <label for="password" :value="__('Password')" />

                <input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <label for="password_confirmation" :value="__('Confirm Password')" />

                <input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

                <button class="ml-4" type="submit">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

