<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_page.css') }}">
    <style>
      
        body {
            font-family: 'Open Sans', sans-serif;            
        }
    </style>
</head>

<body>
    {{-- <table style=" font-size: 11px;">
        <td class="principal">
            <div style="text-align: center; font-size: 9pt">
                <b>SERVICIO TÉCNICO</b>
            <br>
                {{ $data }}
            <br>
                <b>Sucursal: </b> {{ $nombre_sucursal}}
            </div>
            <hr class="linea">
            <div style="text-align: center; font-size: 7pt;">
                <b>CLIENTE: </b> 
            </div>
            <div style="font-size: 7pt; line-heigh: 12px">
            <b>CELULAR:</b>
            <br>
            <b>SERVICIO:</b>
            <br>
            <b>DESCRIPCIÓN:</b>
            <br>
            <b>FALLA:</b>
            <br>
            <b>DIAGNÓSTICO:</b>
            <br>
            <b>SOLUCIÓN:</b>
            <br>
            <b>F. RECEPCIÓN:</b>
            <br>
            <b>F. ENTREGA:</b>
            <br>
            <b>TIPO SERV.:</b>
            <br>
            <b>RESP. TÉCNICO: </b>
            </div>
            <hr class="linea">
            <b>TOTALES:</b>

        </td>
    </table> --}}

    @for($i = 0; $i < 3; $i++)
    
   
<section style="height: 500px;">

    <section  class="header"  style="top: -290px; left:-30px;">


        <table style=" font-size: 11px;">
            <tr>
                {{-- Primera columna --}}
                <td style="width: 4.3cm; vertical-align: top; margin-left: 5px; margin-right:5px">
                    <div style=" font-size: 9pt; text-align: center;">
                        <div>
                            <b>SERVICIO TÉCNICO<br>{{ $data }}</b> <br>
                            <b>Sucursal: </b>{{$sucursal->name}}
                        </div>
                    </div>
                    <hr
                        style="border-color: black; margin-top: 0px; margin-bottom: 3px; margin-left: 5px; margin-right:5px">
                    <div style="text-align: center; font-size: 7pt;">
                        <b>CLIENTE: </b>
                        {{$cliente->nombre}}
                    </div>
    
                    <div style=" font-size: 7pt; line-height: 12px">
                        <b>CELULAR: </b>{{$sucursal->telefono}} - {{$sucursal->celular}}
                        <br>
                        <b>SERVICIO: </b>{{$servicio->id}}
                        <br>
                        <b>DESCRIPCIÓN: </b>{{$servicio->detalle}}  {{$servicio->marca}}
                        <br>
                        <b>FALLA:</b>{{$servicio->falla_segun_cliente}}
                        <br>
                        <b>DIAGNÓSTICO: </b>{{$servicio->diagnostico}}
                        <br>
                        <b>SOLUCIÓN: </b>{{$servicio->solucion}}
                        <br>
                        <b>F. RECEPCIÓN:</b>{{$servicio->created_at}}
                        <br>
                        <b>F. ENTREGA: </b>{{$servicio->fecha_estimada_entrega}}
                        <br>
                        <div style="font-size: 7pt">
                            <b>TIPO SERV.: </b><br>
                        </div>
                        <b>RESP. TÉCNICO: </b>
                        <br>
                    </div>
                    <hr
                        style="border-color: black; margin-top: 0px; margin-bottom: 1px; margin-left: 5px; margin-right:5px">
                    <table id="derechatabla" style="font-weight: bold; font-size: 7pt">
                        <tr>
                            <td style="text-align: right;">TOTALES:</td>
                            <td style="text-align: right;">
                                <b>solu</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">A CUENTA:</td>
                            <td style="text-align: right;">
                                <b>solu</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">SALDO:</td>
                            <td style="text-align: right;">
                                <b>solu</b>
                            </td>
                        </tr>
                    </table>
                </td>
    
    
    
                <td style="width: 5px;"></td> {{-- espaciador entre columnas --}}
                {{-- Aqui comienza la segunda columna --}}
                <td style="width: 15.3cm; vertical-align: top; margin-left: 5px; margin-right:5px;">
                    <div>
                        <table>
                            <tr>
                                <td width="50%">
                                    <div class="col-sm-6 col-md-6" style="text-align: center">
                                        <div class="text-bold"
                                            style="font-size: 15px; margin-top: 0px; margin-bottom: 0px;">
                                            <b>ORDEN DE SERVICIOTÉCNICO<br>{{ $data }}</b>
                                        </div>
                                        <!--<font size="2"><b>Nro.:  </b></font>-->
                                        <span style="font-size: 9px">
                                            {{ \Carbon\Carbon::now()->format('Y-m-d') }}&nbsp;  
                                            &nbsp;{{ \Carbon\Carbon::now()->format('H:i') }}
                                        </span>
                                        <br>
                                    </div>
                                </td>
    
                                <td width="50%">
                                    <div class="col-sm-6 col-md-6">
                                        <div style=" font-size: 10px; text-align: center;">
                                            <span class="text-bold"><u> Soluciones Informaticas Emanuel </u></span><br>
                                            <span style="font-size: 8px">
                                                {{$sucursal->name}} <br>
                                                {{$sucursal->adress}} <br>
                                                {{$sucursal->telefono}}-{{$sucursal->celular}}
                                        </div>
                                    </div>
                                </td>
    
                            </tr>
    
                        </table>

    
                    </div>
                    <hr style="border-color: black; margin: 0px;">
    
                    <div style=" margin-left: 5px; margin-right:5px;">
                        <div style=" display: flex;">
                            <table>
                                <tr>
                                    <td style="width: 300px">
                                        <div style="width: auto;">
                                            <b>FECHA:
                                            </b>{{ \Carbon\Carbon::now()->format('Y-m-d') }}&nbsp; -
                                            &nbsp;{{ \Carbon\Carbon::now()->format('H:i') }}<br>
    
                                            <b>CLIENTE: </b> {{$cliente->nombre}}
                                        </div>
                                    </td>
    
                                    <td style="width: 140px"></td>
    
                                    <td style="width: auto;">
                                        <div style="width: auto; display: flex;">
                                            <table id="derechatabla" style="font-weight: bold;">
                                                <tr>
                                                    <td style="text-align: right;">TOTAL:</td>
                                                    <td style="text-align: right;">
                                                        solu
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right;">A CUENTA:</td>
                                                    <td style="text-align: right;">
                                                        solu
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right;">SALDO:</td>
                                                    <td style="text-align: right;">
                                                        solu
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr style="border-color: black; margin-top: 2px; margin-bottom: 2px">
    
                        <table>
                            <tr>
                                <td style="font-size: 10px; width: 10cm">
                                    <b>SERVICIO: </b><br>
                                    <b>DESCRIPCIÓN:</b>
                                    solu
                                    <br>
                                    <b>FALLA SEGUN CLIENTE: </b>
                                    solu
                                    <br>
                                    <b>DIAGNÓSTICO: </b>
                                    solu
                                    <br>
                                    <b>SOLUCIÓN: </b>
                                    solu
                                    <br>
                                    <b>FECHA ENTREGA APROX.: </b>
                                    solu
                                    <br>
                                    <b>RESPONSABLE TÉCNICO: </b>
                                    solu
                                    <br>
                                    <b>ESTADO: </b>
                                    solu
                                </td>
    
                            </tr>
                        </table>
                    </div>
    
    
                    <hr style="border-color: black;">
                    <div style="width: 100%; font-size: 10px">
                        <table>
                            <tr>
                                <td>
                                    <div class="" style="text-align: center">
                                        <b>RESPONSABLE TÉCNICO </b><br>
                                        solu
    
                                    </div>
                                </td>
    
                                <td style="width: 350px"></td>
    
                                <td>
                                    <div class="text-center">
                                        <b>CLIENTE</b><br>
                                        solu
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
    
                    <div style="display: flex; font-size: 9px; width: 100%">
                        <div style="text-align:center">
    
                            CCA: SIS.INF. Soluciones Informaticas Emanuel ! solu
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    
    
    </section>
</section>

@endfor

</body>

</html>
