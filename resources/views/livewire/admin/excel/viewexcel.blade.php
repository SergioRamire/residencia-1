<table>

    <thead>
        <th>
            {{-- <img src="{{URL::asset('public\img\ico.png')}}" /> --}}
            {{-- <img src="{{asset('public\img\ico.png')}}"> --}}
        </th>
        <th></th>
        <th></th>
    </thead>
    <thead>
        {{-- <link href="style.css" rel="stylesheet" type="text/css"> --}}
        <tr>
            <th></th>
            <th style="text-align:right;">CLAVE DEL CURSO:</th>
            <th style="text-align:left; font-weight: 500;  border-bottom: 1px solid #000000;">{{$data[0]->clave}}</th>
            {{-- <i>{{$data[0]->clave}}</i> --}}
        </tr>
        <tr>
            <th></th>
            <th style="text-align:right;">NOMBRE DEL CURSO:</th>
            <th style="text-align:center; font-weight: 500;  border-bottom: 1px solid #000000;" colspan="2">"{{$data[0]->curso}}"</th>
        </tr>
        <tr>
            <th></th>
            <th style="text-align:right;">NOMBRE DEL INSTRUCTOR:</th>
            <th style="text-align:center; font-weight: 500;  border-bottom: 1px solid #000000;" colspan="2">{{$instructor[0]->nombre}}</th>
        </tr>
        <tr>
            <th></th>
            <th style="text-align:right;">PERIODO:</th>
            @php
            $startdate = new \Carbon\Carbon($data[0]->fi);
            $enddate = new \Carbon\Carbon($data[0]->ff);
            @endphp
            <th>"Del {{$startdate->format('d/m/Y')}} al {{$enddate->format('d/m/Y')}}"</th>
            <th></th>
            <th tyle="text-align:right;" colspan="2">DURACIÓN:</th>
            <th style="text-align:center; font-weight: 500;  border-bottom: 1px solid #000000;" colspan="2">{{$data[0]->duracion}} horas</th>
        </tr>
        <tr>
            <td></td>
            <th style="text-align:right;">HORARIO:</th>
            <th>"      "</th>
        </tr>
        <tr>
            <td></td>
            <th style="text-align:right;">MODALIDAD:</th>
            <th style="text-align:center; font-weight: 500;  border-bottom: 1px solid #000000;">{{$data[0]->modalidad}}</th>
        </tr>
    </thead>
    <thead>
    <tr style = "border: 1px solid # 000000;">
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000; height: 30px;">No.</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000;">NOMBRE DEL PARTICIPE:</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000;">R.F.C</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000;">ÁREA DE ADSCRIPCIÓN</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000;" colspan="5">ASISTENCIA</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000; width: 100px;">CALIFICACION</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000; width: 50px;">F</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000; width: 50px;">M</th>
    </tr>
    <tr>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000; width: 45px;" >L</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000; width: 45px;">M</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000; width: 45px;">M</th>
        <th style="text-align:center; background: #c5c3c3; font-weight: 500;border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; width: 45px;">J</th>
        <th style="text-align:center; background: #c5c3c3; border: 1px solid # 000000; width: 45px;">V</th>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
        <th style="background: #c5c3c3; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;"></th>
    </tr>
    </thead>
    <tbody>
        @php
        $k = 0;
        @endphp
    @foreach($data as $invoice)
        @php
        $k++;
        @endphp
        <tr>
            <td style="text-align:center; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; width: 55px;">{{$k}}</td>
            <td style="text-align:left; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border: 1px solid # 000000; width: 250px;">{{ $invoice->nombre}}</td>
            <td style="text-align:left; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; width: 100px;">{{ $invoice->rfc}}</td>
            <td style="text-align:left; border-top: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; width: 300px;">{{ $invoice->area}}</td>
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
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td style="text-decoration: underline; text-align:center; font-weight: 500;">{{$instructor[0]->nombre}}</td>
        <td></td>
        <td></td>
        <td style="text-decoration: underline; text-align:center; font-weight: 500;" colspan="6">M.C.I.Q. MARÍA DE JESÚS GIL GALLEGOS</td>
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
        <td>{{$instructor[0]->rfc}}</td>
        <td></td>
        <td style="text-align:right;">R.F.C</td>
        <td style="text-align:center; border-bottom: 1px solid #000000;" colspan="6">GIGJ691025I13</td>
    </tr>
    </tbody>
</table>
