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
    <img class="img-header" src="{{ public_path('img/part1.jpg') }}" alt="logo__header"/>
</div>

<p class="font-black">EL TECNOLÓGICO NACIONAL DE MÉXICO</p>
<p class="font-black">A TRAVÉS DEL INSTITUTO TECNOLÓGICO DE OAXACA</p>

<p>OTROGA LA PRESENTE</p>

<p class="font-black">CONSTANCIA</p>
<p>A</p>
<p class="font-black">{{ strtoupper($datos->nombre) }}</p>

<p class="main-text">
    POR SU PARTICIPACION EN EL CURSO "{{ strtoupper($datos->curso) }}" CON EL NUMERO DE REGISTRO:
    "TECNM-135-42-2021/001", LLEVADO A CABO EN LINEA DEL 31 AL 17 DE SEPTIEMBRE DE 2021, CON UNA DURACIÓN DE 30 HORAS.
</p>

<p>OAXACA DE JUÁREZ, OAX, A 17 DE SEPTIEMBRE DE 2021</p>

<p class="font-black">FERNANDO TOLEDO TOLEDO</p>
<p class="font-black">DIRECTOR</p>
</body>
</html>


