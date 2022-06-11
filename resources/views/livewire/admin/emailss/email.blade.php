@component('mail::message')
Estimado(a) docente: **{{$user->name}} {{' '}} {{$user->apellido_paterno}} {{' '}} {{$user->apellido_materno}}**

Con Clave Unica de Registro: {{$user->curp}}

Se le notifica que se ha inscrito exitosamente en los cursos:

    @foreach($info as $i)
    {{$i[0]->name}}{{' y con un horario de '}}{{ Carbon\Carbon::parse($i[0]->horaini)->format('G:i')}}{{' a '}}{{ Carbon\Carbon::parse($i[0]->horafin)->format('G:i')}}{{' horas, en el periodo de '}}{{ Carbon\Carbon::parse($i[0]->fi)->format('d-m-Y')}}{{' a '}}{{ Carbon\Carbon::parse($i[0]->ff)->format('d-m-Y')}}

    @endforeach

{{-- @component('mail::button', ['url' => ''])
Algún Botón
@endcomponent --}}

Atentamente: Departamento de Desarrollo Académico.<br>

*Este correo ha sido generado automáticamente favor de no responder.*
@endcomponent

