<!doctype html>
<html lang="en">

<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table {
            font-size: 12px;
            /* border-collapse: collapse; */
        }

        html {
		margin: 0;
	    }

        body {
                font-family: "Times New Roman", serif;
                /* margin: 0mm 4mm 2mm 2mm; */
            }
            h1{
                height:10px;
                text-align: right;
                font-size: 16px;
            }
            h2{
                height:10px;
                text-align: center;
                font-size: 16px;
            }
            h3{
                height:15px;
                text-align: center;
                font-size: 16px;
            }
            h4{
                height:20px;
                text-align: center;
                font-size: 16px;
            }
            h5{
                height:10px;
                /* text-align: center; */
                font-size: 16px;
            }
            table {
                width: 100%;
                /* border: 2px solid #000; */
                border-collapse: collapse;
            }
            th{
                /* width: 25%; */
                text-align: center;
                /* vertical-align: top; */
                border: 1px solid #000;
                /* border-spacing: 0; */
            }

            td {
                /* width: 25%; */
                text-align: left;
                vertical-align: top;
                /* border: 2px solid #000; */
                border-collapse: collapse;
                border-spacing: 0;
            }

    </style>
</head>

<body>
    <h1></h1>
    <h5 class="container col  col-sm-11">
        <img src="{{ public_path().'/img/tecnm.jpg' }}" width="170" height="110"/>
    </h5>
    <h1 class="container col  col-sm-10">
        <img src="{{ public_path().'/img/ito2.jpg' }}" width="100" height="100"/>
    </h1>

    <h2></h2>
    <h2>TECNOLÓGICO NACIONAL DE MÉXICO</h2>
    <h2> Instituto Tecnológico de Oaxaca</h2>
    <h2></h2>
    <h3>Programa Institucional de Formación Docente y Actualización Profesional</h3>
    <h3></h3>
    <h4>PROGRAMA INSTITUCIONAL DE FORMACIÓN DOCENTE Y ACTUALIZACIÓN PROFESIONAL</h4>
    <h4>INSTITUTO TECNOLÓGICO DE OAXACA</h4>
    <h4>PERIODO {{$courses[0]->claves}}</h4>

    <div class="container py-2 col-sm-11">
        {{-- <h5 class=" font-weight-bold">DOMPDF Tutorial</h5> --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nombre de los cursos</th>
                    <th>Objetivo</th>
                    <th>Perfil de Curso</th>
                    <th>Periodo de Realización</th>
                    <th>Lugar</th>
                    <th>No. de horas por Curso</th>
                    <th>Nombre y grado máximo del Instructor (a)</th>
                    <th>Dirigido a:</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $k = 0;
                @endphp

                @forelse ($courses as $curso)
                    @php
                        $k++;
                    @endphp
                    @php
                        $startdate = new \Carbon\Carbon($courses[0]->fi);
                        $enddate = new \Carbon\Carbon($courses[0]->ff);
                    @endphp

                <tr>
                    <td class="text-center">{{ $k}}</td>
                    <td>{{ $curso->curso }}</td>
                    <td>{{ $curso->objetivo }}</td>
                    <td>{{ $curso->per }}</td>
                    <td class="text-center">{{$startdate->format('d/m/Y')}} al {{$enddate->format('d/m/Y')}}</td>
                    <td class="text-center">{{ $curso->lugar }}</td>
                    <td class="text-center">{{ $curso->duracion }} horas</td>
                    <td>{{ $curso->nombre }}</td>
                    <td>{{ $curso->dirigido }}</td>
                    <td>{{ $curso->obs }}</td>
                </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
    <div class="container py-2 col-sm-8">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Elaboró</th>
                     <th>Aprobó</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        algo
                    </td>
                    <td>
                        fugaa
                    </td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th>Nombre  y firma</th>
                     <th>Nombre y firma</th>
                </tr>
                <tr>
                    <th class="text-left">Fecha:</th>
                    <th class="text-left">Fecha:</th>
                </tr>
            </thead>
        </table>

    </div>
</body>

</html>
