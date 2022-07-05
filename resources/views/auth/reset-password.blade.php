<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center justify-center m-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-green-600 m-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                <span class="justify-center">Recuperar contraseña</span>
            </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-secondary-button type="submit" class="ml-4 bg-white border-[#1b396a] text-sky-700 hover:text-white hover:bg-sky-800 active:text-sky-50 active:bg-sky-500">
                    {{ __('Reset Password') }}
                </x-jet-secondary-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
