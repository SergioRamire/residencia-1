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

<p id="titulo-tec-1">EL TECNOLÓGICO NACIONAL DE MÉXICO</p>
<p id="titulo-tec-2">A TRAVÉS DEL INSTITUTO TECNOLÓGICO DE OAXACA</p>

<p id="otorga">OTORGA LA PRESENTE</p>

<p id="constancia">CONSTANCIA</p>
<p id="a">A</p>
<p id="nombre">{{ strtoupper($datos->nombre) }}</p>

<p id="texto-principal">POR SU PARTICIPACIÓN EN EL CURSO "{{ strtoupper($datos->curso) }}" CON EL NÚMERO DE REGISTRO: "TECNM-135-42-2021/001", LLEVADO A CABO EN LINEA DEL 31 AL 17 DE SEPTIEMBRE DE 2021, CON UNA DURACIÓN DE 30 HORAS.</p>

<p id="fecha">OAXACA DE JUÁREZ, OAX, A 17 DE SEPTIEMBRE DE 2021</p>

<p id="director-nombre">FERNANDO TOLEDO TOLEDO</p>
<p id="director">DIRECTOR</p>
</body>
</html>


