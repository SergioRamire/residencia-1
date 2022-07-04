@component('mail::message')
Estimado(a) docente: **{{$user->name}} {{' '}} {{$user->apellido_paterno}} {{' '}} {{$user->apellido_materno}}**<br>
   **{{$info}}**

{{-- @component('mail::button', ['url' => ''])
Algún Botón
@endcomponent --}}

Atentamente: Departamento de Desarrollo Académico.<br>

*Este correo ha sido generado automáticamente favor de no responder.*
@endcomponent
