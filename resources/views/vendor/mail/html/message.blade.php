@component('mail::layout')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{-- {{ config('app.name') }} --}}
        {{-- {{'SISTEMA DE CURSOS INTERSEMESTRALES DE DOCENTES DEL INSTITUTO TECNOLOGICO DE OAXACA.'}}<br> --}}
        {{date('d/m/Y') }}
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
    {{-- © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.') --}}

    ©{{ date('Y') }} {{ 'Ejercicio de programación' }}
@endcomponent
@endslot
@endcomponent
