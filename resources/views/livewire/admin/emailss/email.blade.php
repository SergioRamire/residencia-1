@component('mail::message')
Estimado(a) docente: **{{$user->name}} {{' '}} {{$user->apellido_paterno}} {{' '}} {{$user->apellido_materno}}**

Con Clave Unica de Registro: {{$user->curp}}

Usted ha sido inscrito exitósamente en los cursos:

    @foreach($info as $i)
    "{{$i[0]->name}}"{{' grupo: '}}{{$i[0]->grupo}}{{', lugar: '}}{{$i[0]->lugar}}
        {{'      Horario de: '}}{{ Carbon\Carbon::parse($i[0]->horaini)->format('G:i')}}{{' a '}}{{ Carbon\Carbon::parse($i[0]->horafin)->format('G:i')}}{{' horas, en el curso intersemestral '}}{{$i[0]->clave}}

    @endforeach



Atentamente: Departamento de Desarrollo Académico.<br>

*Este correo ha sido generado automáticamente favor de no responder.*
@endcomponent

