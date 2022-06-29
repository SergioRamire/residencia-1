<x-guest-layout>
    <x-jet-authentication-card>

        <x-slot name="logo">
            <h2 class="justify-center text-justify text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Cursos Intersemestrales
            </h2>
            <div class="flex items-center justify-center">
                <span class="justify-center">Siempre es un buen momento para aprender</span>
            </div>
        </x-slot>




        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <x-slot name="boton">
                <button
                class="inline-flex onclick items-center px-4 py-2 bg-white
                rounded-t-lg font-semibold text-xs uppercase tracking-widest shadow-sm
                focus:outline-none focus:ring
                focus:ring-blue-200 disabled:opacity-25 transition
                text-sky-700 hover:text-white hover:bg-sky-800 active:text-sky-50 active:bg-sky-500">
                    Participantes
                </button>
                <button wire:click=""
                class="inline-flex items-center px-4 py-2 bg-white
                rounded-t-lg font-semibold text-xs uppercase tracking-widest shadow-sm
                focus:outline-none focus:ring
                focus:ring-blue-200 disabled:opacity-25 transition
                text-sky-700 hover:text-white hover:bg-sky-800 active:text-sky-50 active:bg-sky-500">
                Instructor
                </button>
            </x-slot>
            <div class="mt-2">
                <img src="{{ asset('img/ico.png') }}">
            </div>
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4 ">
                <label for="remember_me" class="flex items-center ">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-jet-secondary-button type="submit" class="ml-4 bg-white border-sky-800 text-sky-700 hover:text-white hover:bg-sky-800 active:text-sky-50 active:bg-sky-500">
                    {{ __('Log in') }}
                </x-jet-secondary-button>
            </div>
        </form>

        {{-- <form method="get" action="{{ route('register') }}">
            <div class="flex items-center justify-center mt-4">
                <x-jet-button  class="ml-4 bg-gray-200 text-gray-900">
                    Registrar
                </x-jet-button>
            </div>
        </form> --}}




    </x-jet-authentication-card>
</x-guest-layout>
