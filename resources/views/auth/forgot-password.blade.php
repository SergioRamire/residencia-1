<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center justify-center m-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-red-600 m-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                <span class="justify-center">¿Olvidaste tu contraseña? No hay problema.</span>
            </div>

        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-secondary-button type="submit" class="ml-4 bg-white border-sky-800 text-sky-700 hover:text-white hover:bg-sky-800 active:text-sky-50 active:bg-sky-500">
                    {{ __('Email Password Reset Link') }}
                </x-jet-secondary-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
