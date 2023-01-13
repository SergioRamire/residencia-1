<x-guest-layout>
    <x-jet-authentication-card>

        <x-slot name="logo">
            <h2 class="justify-center text-justify text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Cursos Intersemestrales
            </h2>
            <div class="flex items-center justify-center">
                <span class="justify-center"></span>
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
            <div class="mb-8 flex justify-center">
                <label class="items-center p-2 m-2 bg-white font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring focus:ring-blue-200 disabled:opacity-25 text-sky-700 transition ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-blue-50 duration-300">
                    <input checked name="rol" value="Participante" id="rol" type="radio"  class="w-4 h-4 text-[#1b396a] bg-gray-100 border-gray-300 focus:ring-sky-700 focus:ring-2 ">
                    <span class="ml-2 text-sm font-medium text-gray-900 ">Participante</span>
                </label>
                <label class="items-center p-2 m-2 bg-white font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring focus:ring-blue-200 disabled:opacity-25 text-sky-700 transition ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-blue-50 duration-300">
                    <input name="rol" value="Instructor" id="rol" type="radio" class="w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 focus:ring-orange-500 focus:ring-2">
                    <span class="ml-2 text-sm font-medium text-gray-900 ">Instructor</span>
                </label>
            </div>
            <div class="mt-2">
                <img src="{{ asset('img/ico.png') }}">
            </div>
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <div class="mt-4" x-data="{showPassword: false}">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <x-jet-input x-bind:type="showPassword ? 'text' : 'password'" id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                                 autocomplete="current-password" />
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg x-show="!showPassword" x-on:click="showPassword = !showPassword" class="w-6 h-6 hover:text-[#1b396a]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                        <svg x-show="showPassword" x-on:click="showPassword = !showPassword" class="w-6 h-6 hover:text-[#1b396a]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                    </button>
                </div>
            </div>

            <div class="block mt-4 ">
                <label for="remember_me" class="flex items-center ">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-black hover:text-sky-700 active:text-sky-500">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-black hover:text-sky-700 active:text-sky-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-jet-secondary-button type="submit" class="ml-4 bg-white border-[#1b396a] text-sky-700 hover:text-white hover:bg-sky-800 active:text-sky-50 active:bg-sky-500">
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
