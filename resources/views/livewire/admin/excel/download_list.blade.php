<table>

    <thead>
        <tr>
            <td style="text-align:center; font-weight: 500;  border: 1px solid # 000000;" rowspan="6" colspan="2">
                <img src="{{ public_path().'/img/sep-tecnm.png' }}" width="100" height="57" align="rigth"/>
            </td>
            <td style="text-align:center; vertical-align: bottom; font-weight: 500;  border: 1px solid # 000000;" rowspan="3" colspan="7">
                TECNOLÓGICO NACIONAL DE MÉXICO <br>
                Instituto Tecnológico de Oaxaca <br>

            </td>
            <td style="text-align:center; font-weight: 500;  border: 1px solid # 000000;" rowspan="6" colspan="3">
                <img src="{{ public_path().'/img/ito2.png' }}" width="100" height="100" align="center"/>
            </td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td style="text-align:center; font-size: 16px; font-weight: 500;" rowspan="2" colspan="7">
                Lista de Asistencia
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td style="text-align:right;  border-bottom: 1px solid #000000;" colspan="7">
                REG-7200-05  Rev.01
            </td>
        </tr>

    </thead>
    <thead>
        {{-- Parte de los titulos del excel --}}
        <tr></tr>

        <tr>
            <th></th>
            <th style="text-align:right;">INSTITUTO TECNOLÓGICO O CENTRO DE TRABAJO:</th>
            <th style="text-align:left; font-weight: 500;  border-bottom: 1px solid #000000;">DE OAXACA</th>
        </tr>
        <tr>
            <th></th>
            <th style="text-align:right;">CLAVE DEL CURSO:</th>
            <th style="text-align:left; font-weight: 500;  border-bottom: 1px solid #000000;">{{$data[0]->clave}}</th>
            <th></th>
            <th style="text-align:center; font-weight: 500;" colspan="2">FOLIO:</th>
            <th style="text-align:center; font-weight: 500; border-bottom: 1px solid #000000;" colspan="2"></th>
        </tr>
        <tr>
            <th></th>
            <th style="text-align:right;">NOMBRE DEL CURSO:</th>
            <th style="text-align:center; font-weight: 500;  border-bottom: 1px solid #000000;" colspan="2">"{{$data[0]->curso}}"</th>
        </tr>
        <tr>
            <th></th>
            <th style="text-align:right;">NOMBRE DEL INSTRUCTOR:</th>
            <th style="text-align:center; font-weight: 500;  border-bottom: 1px solid #000000;" colspan="2">{{$instructor->name}} {{$instructor->apellido_paterno}} {{$instructor->apellido_materno}}</th>
        </tr>
        <tr>
            <th></th>
            <th style="text-align:right;">PERÍODO:</th>
            @php
            $startdate = new \Carbon\Carbon($data[0]->fi);
            $enddate = new \Carbon\Carbon($data[0]->ff);
            @endphp
            <th style="font-weight: 500;  border-bottom: 1px solid #000000;" colspan="2">Del {{$startdate->format('d/m/Y')}} al {{$enddate->format('d/m/Y')}}</th>
            <th></th>
            <th tyle="text-align:right;" colspan="2">DURACIÓN:</th>
            <th style="text-align:center; font-weight: 500;  border-bottom: 1px solid #000000;" colspan="2">{{$data[0]->duracion}} horas</th>
        </tr>
        <tr>
            @php
            $starthour= new \Carbon\Carbon($data[0]->hi);
            $endhour = new \Carbon\Carbon($data[0]->hf);
            @endphp
            <td></td>
            <th style="text-align:right;">HORARIO:</th>
            <th style="font-weight: 500;  border-bottom: 1px solid #000000;" colspan="2">{{$starthour->format('H:i')}} A {{$endhour->format('H:i')}} HORAS</th>
        </tr>
        <tr>
            <td></td>
            <th style="text-align:right;">MODALIDAD:</th>
            <th style="text-align:center; font-weight: 500;  border-bottom: 1px solid #000000;">{{$data[0]->modalidad}}</th>
        </tr>
    </thead>
    <thead>
        {{-- encabezados de la tabla --}}
    <tr style = "border: 1px solid # 000000;">
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000; height: 20px;" rowspan="2">No.</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000;">NOMBRE DEL PARTICIPANTE:</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000;">R.F.C</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000;">ÁREA DE ADSCRIPCIÓN</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000;" colspan="5">ASISTENCIA</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000; width: 100px;">CALIFICACIÓN</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000; width: 45px;" rowspan="2">F</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000; width: 45px;" rowspan="2">M</th>
    </tr>
    <tr>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000; width: 45px;">L</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000; width: 45px;">M</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000; width: 45px;">M</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000; width: 45px;">J</th>
        <th style="text-align:center; font-weight: 500; background: #c5c3c3; border: 1px solid # 000000; width: 45px;">V</th>
        <th style="background: #c5c3c3;  border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
    </tr>
    </thead>
    {{-- cuerpo de la tabla --}}
    <tbody>
        @php
        $k = 0;
        @endphp
    @foreach($data as $invoice)
        @php
        $k++;
        @endphp
        <tr>
            <td style="text-align:center; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; width: 45px;">{{$k}}</td>
            <td style="text-align:left; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border: 1px solid # 000000; width: 235px;">{{ $invoice->nombre}}</td>
            <td style="text-align:left; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; width: 110px;">{{$invoice->rfc}}</td>
            <td style="text-align:left; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; width: 285px;">{{mb_strtoupper(Str::of($invoice->area)->after('Departamento de'),'utf-8')}}</td>
            <td style="text-align:center; background: #ebebeb; border: 1px solid # 000000;"> </td>
            <td style="text-align:center; background: #ebebeb; border: 1px solid # 000000;"> </td>
            <td style="text-align:center; background: #ebebeb; border: 1px solid # 000000;"> </td>
            <td style="text-align:center; background: #ebebeb; border: 1px solid # 000000;"> </td>
            <td style="text-align:center; background: #ebebeb; border: 1px solid # 000000;"> </td>
            <td style="text-align:center; border: 1px solid # 000000;"> </td>
            @if($invoice->sex == 'F')
                <th style="text-align:center; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;">X</th>
                <td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"> </td>
            @elseif($invoice->sex == 'M')
                <td style="border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></td>
                <td style="text-align:center; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;">X</td>
            @endif
        </tr>
    @endforeach
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    {{-- <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr> --}}
    <tr>
        <td></td>
        <td style="text-decoration: underline; text-align:center; font-weight: 500;">{{mb_strtoupper($instructor->name,'utf-8')}} {{mb_strtoupper($instructor->apellido_paterno,'utf-8')}} {{mb_strtoupper($instructor->apellido_materno,'utf-8')}}</td>
        <td></td>
        <td></td>
        <td style="text-decoration: underline; text-align:center; font-weight: 500;" colspan="6">{{mb_strtoupper(Str::words($cordinador[0]->estudio_maximo,1,' '))}}{{' '}}{{mb_strtoupper($cordinador[0]->name,'utf-8')}} {{mb_strtoupper($cordinador[0]->apellido_paterno,'utf-8')}} {{mb_strtoupper($cordinador[0]->apellido_materno,'utf-8')}}</td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align:center;">NOMBRE Y FIRMA DEL INSTRUCTOR</td>
        <td></td>
        <td></td>
        <td style="text-align:center;" colspan="6">NOMBRE Y FIRMA DE LA COORDINADORA</td>
    </tr>
    <tr>
        <td style="text-align:right;">R.F.C:</td>
        <td>{{strtoupper($instructor->rfc)}}</td>
        <td></td>
        <td style="text-align:right;">R.F.C</td>
        <td style="text-align:center; border-bottom: 1px solid #000000;" colspan="6">{{strtoupper($cordinador[0]->rfc)}}</td>
    </tr>
    <tr>
        <td style="text-align:right;">C.U.R.P:</td>
        <td>{{strtoupper($instructor->curp)}}</td>
        <td></td>
        <td style="text-align:right;">C.U.R.P:</td>
        <td style="text-align:center; border-bottom: 1px solid #000000;" colspan="6">{{strtoupper($cordinador[0]->curp)}}</td>
    </tr>
    </tbody>
</table>
