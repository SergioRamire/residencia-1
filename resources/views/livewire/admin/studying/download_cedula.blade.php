<!doctype html>
<html lang="en">

<head>
    <title>{{mb_strtoupper($courses[0]->nombre,'utf-8')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>

        table {
            font-size: 12px;
            /* border-collapse: collapse; */
        }

        html {
		margin: 3;
	    }

        body {
            font-family: "Times New Roman", Times, serif;
                /* margin: 0mm 4mm 2mm 2mm; */
            }
            h1{
                height:8px;
                text-align: right;
                font-size: 14px;
            }
            h2{
                height:8px;
                text-align: center;
                font-size: 14px;
            }
            h3{
                height:15px;
                text-align: right;
                font-size: 13px;
            }
            h4{
                height:15px;
                text-align: right;
                font-size: 16px;
            }
            h5{
                height:8px;
                /* text-align: center; */
                font-size: 14px;
            }
            h6{
                height:12px;
                text-align: left;
                font-size: 12px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th{
                text-align: left;
            }

            td {
                /* width: 25%; */
                text-align: left;
                vertical-align: top;
                border-collapse: collapse;
                border-spacing: 0;
            }
            .linea {
                border-top: 1px solid black;
                height: 0px;
                padding: 0;
                margin: 5px auto 2 auto;
            }

    </style>
</head>

<body>
    <h5 class="container col  col-sm-11">
        <img src="{{ public_path().'/img/tecnm.jpg' }}" width="170" height="110"/>
    </h5>
    <h1 class="container col  col-sm-10">
        <img src="{{ public_path().'/img/ito2.jpg' }}" width="100" height="100"/>
    </h1>

    <div class="">
        <h2 >TECNOLÓGICO NACIONAL DE MÉXICO</h2>
        <h2> Instituto Tecnológico de Oaxaca</h2>
        <h2></h2>
        <h2>Cédula de Inscripción</h2>
        <h4 class="container col  col-sm-5">REG-7200-04 Rev 01</h4>
    </div>

    <div class="container py-2 col-sm-11">
        <h1 >FECHA: {{mb_strtoupper($day_actual,'utf-8')}}</h1>
        <table>
            <thead>
                <td bgcolor="silver">
                    <h2 class="text-decoration: underline">DATOS DEL EVENTO</h2>
                </tr>
            </thead>
        </table>
        <h6 class="container col  col-sm-14 ">CLAVE DEL CURSO: {{mb_strtoupper($courses[0]->curso_clave,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <h6 class="container col  col-sm-14 ">NOMBRE DEL CURSO: {{mb_strtoupper($courses[0]->curso_nombre,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <h6 class="container col  col-sm-14 ">NOMBRE DEL INSTRUCTOR: {{mb_strtoupper($ins[0]->nombre,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <h6 class="container col  col-sm-14">PERÍODO DE REALIZACIÓN: {{mb_strtoupper($fecha_i,'utf-8')}} AL {{mb_strtoupper($fecha_f,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <table>
            <thead>
                <tr>
                    <th>
                        <h6 class="container col  col-sm-14">HORARIO:</h6>
                    </th>
                    <th>
                        @php
                            $starthour= new \Carbon\Carbon($courses[0]->h1);
                            $endhour = new \Carbon\Carbon($courses[0]->h2);

                            $hora_entrada= new \Carbon\Carbon($courses[0]->hora_entrada);
                            $hora_salida = new \Carbon\Carbon($courses[0]->hora_salida);
                        @endphp
                        <h6 class="container col  col-sm-14">{{$starthour->format('H:i')}} A {{$endhour->format('H:i')}}</h6>
                        <div class="linea container col  col-sm-14"></div>
                    </th>
                    <th>
                        <h6 class="container col  col-sm-8 ">MODALIDAD:</h6>
                    </th>
                    <th>
                        <h6 class="container col  col-sm-12 "> {{mb_strtoupper($courses[0]->modalidad,'utf-8')}}</h6>
                        <div class="linea container col  col-sm-12"></div>
                    </th>
                    <th>
                        <h6 class="container col  col-sm-5 ">DURACIÓN: </h6>
                    </th>
                    <th>
                        <h6 class="container col  col-sm-12 "> {{mb_strtoupper($courses[0]->duracion,'utf-8')}} HORAS</h6>
                         <div class="linea container col  col-sm-12"></div>
                    </th>
                </tr>
            </thead>
        </table>
        <table style="padding-top: 8px;">
            <thead>
                <td bgcolor="silver">
                    <h2 class="text-decoration: underline">DATOS PERSONALES</h2>
                </tr>
            </thead>
        </table>
        @if($courses[0]->sexo == 'M')
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>
                        <h3 class="container col  col-sm-12">HOMBRE ( X )</h3>
                    </th>
                    <th>
                        <h3 class="container col  col-sm-2 ">MUJER (  )</h3>
                    </th>
                </tr>
            </thead>
        </table>
        @elseif($courses[0]->sexo == 'F')
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>
                        <h3 class="container col  col-sm-12">HOMBRE (  )</h3>
                    </th>
                    <th>
                        <h3 class="container col  col-sm-2">MUJER ( X )</h3>
                    </th>
                </tr>
            </thead>
        </table>
        @endif

        <table>
            <thead>
                <tr>
                    <th>
                        <h6 class="container col  col-sm-14">NOMBRE:</h6>
                        <div class="linea container col  col-sm-14"></div>
                    </th>
                    <th>
                        <h6 >{{mb_strtoupper($courses[0]->app,'utf-8')}}</h6>

                        <div class="linea container col  col-sm-14"></div>
                    </th>
                    <th>
                        <h6 >{{mb_strtoupper($courses[0]->apm,'utf-8')}}</h6>
                        <div class="linea container col  col-sm-14"></div>
                    </th>
                    <th>
                        <h6 >{{mb_strtoupper($courses[0]->name,'utf-8')}}</h6>
                        <div class="linea container col  col-sm-14"></div>
                    </th>

                </tr>
            </thead>
        </table>
        <table style="padding-top: 15px;">
            <thead>
                <tr>
                    <th>
                        <h6 class="line container col  col-sm-14">R.F.C (CON HOMOCLAVE).: <u> {{ mb_strtoupper($courses[0]->rfc,'utf-8')}} </u></h6>
                    </th>
                    <th>
                        <h6 class=" container col  col-sm-12"></h6>
                    </th>
                    <th>
                        <h6 class="line container col  col-sm-14">CURP: <u> {{mb_strtoupper($courses[0]->curp,'utf-8')}} </u></h6>
                    </th>
                </tr>
            </thead>
        </table>
        <h6 class="container col  col-sm-14 " style="padding-top: 10px;">CORREO ELECTRÓNICO: {{mb_strtoupper($courses[0]->correo,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <h6 class="container col  col-sm-14 ">GRADO MÁXIMO DE ESTUDIOS: {{mb_strtoupper($courses[0]->estudio_maximo,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <h6 class="container col  col-sm-14 ">NOMBRE DE LA CARRERA: {{mb_strtoupper($courses[0]->carrera,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <table style="padding-top: 8px;">
            <thead>
                <td bgcolor="silver" >
                    <h2 class="text-decoration: underline">DATOS LABORALES</h2>
                </tr>
            </thead>
        </table>
        <h6 class="container col  col-sm-14 "style="padding-top: 8px;">INSTITUTO TECNOLÓGICO O CENTRO: INSTITUTO TECNOLÓGICO DE OAXACA</h6>
        <div class="linea container col  col-sm-14"></div>
        <h6 class="container col  col-sm-14 ">ÁREA DE ADSCRIPCIÓN: {{mb_strtoupper($courses[0]->nombre_area,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <h6 class="container col  col-sm-14 ">PUESTO QUE DESEMPEÑA: {{mb_strtoupper($courses[0]->puesto,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <h6 class="container col  col-sm-14 ">CLAVE PRESUPUESTAL: {{mb_strtoupper($courses[0]->clave_presupuestal,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <h6 class="container col  col-sm-14 ">NOMBRE DEL JEFE INMEDIATO: {{mb_strtoupper($courses[0]->jefe,'utf-8')}}</h6>
        <div class="linea container col  col-sm-14"></div>
        <table>
            <thead>
                <tr>
                    <th>
                        <h6 class="container col  col-sm-14">TELÉFONO OFICIAL: {{mb_strtoupper($courses[0]->telefono,'utf-8')}}</h6>
                        <div class="linea container col  col-sm-14"></div>
                    </th>
                    <th>
                        <h6 class=" container col  col-sm-12"></h6>
                    </th>
                    <th>
                        <h6 class="line container col  col-sm-14">EXTENSION: <u> {{$courses[0]->extension}} </u></h6>
                    </th>
                </tr>
            </thead>
        </table>

        <h6 class="container col  col-sm-14 ">HORARIO: {{$hora_entrada->format('H:i')}} A {{$hora_salida->format('H:i')}}</h6>
        <div class="linea container col  col-sm-14"></div>

        <h2 style="padding-top: 45px;" class="container col  col-sm-14 ">________________________</h2>
        <h2 style="padding-top: 5px;" class="container col  col-sm-14 ">Firma</h2>
    </div>

</body>

</html>
