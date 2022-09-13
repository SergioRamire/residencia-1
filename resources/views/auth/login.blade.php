<x-guest-layout>
    <x-jet-authentication-card>

        <x-slot name="logo">
            <h2 class="justify-center text-justify text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Denuncias viales
            </h2>
            {{-- <div class="flex items-center justify-center">
                <span class="justify-center">Siempre es un buen momento para aprender</span>
            </div> --}}
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
                {{-- <label class="items-center p-2 m-2 bg-white font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring focus:ring-blue-200 disabled:opacity-25 text-sky-700 transition ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-blue-50 duration-300">
                    <input checked name="rol" value="Participante" id="rol" type="radio"  class="w-4 h-4 text-[#1b396a] bg-gray-100 border-gray-300 focus:ring-sky-700 focus:ring-2 ">
                    <span class="ml-2 text-sm font-medium text-gray-900 ">Participante</span>
                </label>
                <label class="items-center p-2 m-2 bg-white font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring focus:ring-blue-200 disabled:opacity-25 text-sky-700 transition ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-blue-50 duration-300">
                    <input name="rol" value="Instructor" id="rol" type="radio" class="w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 focus:ring-orange-500 focus:ring-2">
                    <span class="ml-2 text-sm font-medium text-gray-900 ">Instructor</span>
                </label> --}}
            </div>
            <div class="mt-2">
                <img src="{{ asset('img/ito2.jpg') }}">
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

        <form method="get" action="{{ route('register') }}">
            <div class="flex items-center justify-center mt-4">
                <x-jet-button  class="ml-4 bg-gray-200 text-gray-900">
                    Registrar
                </x-jet-button>
            </div>
        </form>

    </x-jet-authentication-card>
</x-guest-layout>
