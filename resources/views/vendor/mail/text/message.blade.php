@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
            {{-- {{'Sistema de cursos de Capacitación docente del Técnologico de Oaxaca.'}} --}}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
            {{-- ©{{ date('Y') }} {{ 'Todos los derecho reservados del Departamento de Desarrollo Académico.' }} --}}
        @endcomponent
    @endslot
@endcomponent
