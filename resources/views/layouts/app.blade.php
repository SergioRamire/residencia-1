<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles
        @stack('styles')
        <style>[x-cloak]{display: none}</style>

        <!-- Scripts -->
        {{-- Jq --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        {{-- S2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="{{ mix('js/app.js') }}" defer></script>
        @stack('scripts')
    </head>
    <body class="font-sans antialiased">
        <div x-data="{ sidebarOpen: false } " @keydown.escape.window="sidebarOpen = false">

            <!-- Parte izquierda -->
            <x-sidebar/>

            <!-- Parte derecha -->
            <div class="md:pl-64 flex flex-col flex-1 min-h-screen">
                <x-nav/>

                <main class="flex-1">
                    <div class="pt-6">

                        <!-- Cabecera -->
                        @if(isset($header))
                            <header class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                                {{ $header }}
                            </header>
                        @endif

                        <!-- Contenido -->
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                </main>

                <x-footer/>
            </div>
        </div>

        @stack('modals')

        <!-- Notificaciones -->
        <div aria-live="assertive" class="fixed top-16 bottom-0 left-0 right-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
            <div class="w-full flex flex-col items-center space-y-4 sm:items-end">

                <x-notification/>

            </div>
        </div>

        <x-back-top/>
        @livewireScripts

    </body>
</html>
