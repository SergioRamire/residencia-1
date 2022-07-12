<!DOCTYPE html>
<html lang="es">
<head>
    <title>{{ $datos->nombre }} - {{ $datos->curso }} - {{ $datos->grupo }}</title>
    <link rel="stylesheet" href="{{ public_path('css/constancias.css') }}">
    <style>
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path('fonts/Montserrat-Regular.ttf') }}) format('truetype');
        }
        @font-face {
            font-family: 'Montserrat-Black';
            font-style: normal;
            font-weight: bold;
            src: url({{ storage_path('fonts/Montserrat-Black.ttf') }}) format('truetype');
        }
    </style>
</head>
<body>

<div>
    <img id="img-header" src="{{ public_path('img/part1.jpg') }}" alt="logo__header"/>
</div>
@php
    $year = new \Carbon\Carbon($datos->fi);
@endphp

<p id="titulo-tec-1">EL TECNOLÓGICO NACIONAL DE MÉXICO</p>
<p id="titulo-tec-2">A TRAVÉS DEL INSTITUTO TECNOLÓGICO DE OAXACA</p>

<p id="otorga">OTORGA LA PRESENTE</p>

<p id="constancia">CONSTANCIA</p>
<p id="a">A</p>
<p id="nombre">{{mb_strtoupper($datos->nombre,'utf-8')}}</p>

<p id="texto-principal">POR SU PARTICIPACIÓN EN EL CURSO "{{mb_strtoupper($datos->curso,'utf-8')}}" CON EL NÚMERO DE REGISTRO: "TNM-135-42-{{$year->format('Y')}}/{{$numlist}}", LLEVADO A CABO EN LINEA DEL {{mb_strtoupper($fi,'utf-8')}} AL {{mb_strtoupper($ff,'utf-8')}}, CON UNA DURACIÓN DE {{$datos->duracion}} HORAS.</p>

<p id="fecha">OAXACA DE JUÁREZ, OAX, A {{ mb_strtoupper($day,'utf-8')}}</p>

<p id="director-nombre">FERNANDO TOLEDO TOLEDO</p>
<p id="director">DIRECTOR</p>

<footer>
    <div>
        <img src="{{ public_path().'/img/ito2.jpg' }}" width="70" height="70" align="left"/>
    </div>
    <div>
        <img src="{{ public_path().'/img/Certificacion.jpg' }}" width="90" height="75" align="right"/>
    </div>
</footer>
</body>
</html>


