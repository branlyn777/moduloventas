<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body>

    @foreach ($servicios as $s)
        <section style="height: 700px;">

            <table style="font-size: 11px;padding-left: 0px;margin-left:-30px;margin-top: -15px">
                <tr>
                    {{-- Primera columna --}}
                    <td style="width: 4.2cm; vertical-align: top;margin-right:0px">
                        <div style=" font-size: 9pt; text-align: center;">
                            <div>
                                <b>SERVICIO TÉCNICO<br>{{ $data }}</b><br><b>Sucursal:
                                </b>{{ $sucursal->name }}
                            </div>
                        </div>
                        <hr
                            style="border-color: black; margin-top: 0px; margin-bottom: 3px; margin-left: 0px; margin-right:0px">
                        <div style="text-align: left; font-size: 7pt;">
                            <b>CLIENTE: </b>{{ $cliente->nombre }}
                        </div>

                        <div style=" font-size: 7pt; line-height: 12px">
                            <b>CELULAR: </b>{{ $cliente->telefono == 0 ? ' ' : $cliente->telefono . '-' }}
                            {{ $cliente->celular }}<br>
                            <b>SERVICIO: </b>{{ $loop->iteration }}&nbsp;&nbsp;<br <b>DESCRIPCIÓN:
                            </b>{{ $s->mark }} {{ $s->detail }}<br>
                            <b>FALLA:</b>{{ $s->client_fail }}
                            <br>
                            <b>DIAGNÓSTICO: </b>{{ $s->diag }}
                            <br>
                            <b>SOLUCIÓN: </b> {{ $s->servi }}
                            <br>
                            <b>F. RECEPCIÓN:</b>
                            {{ \Carbon\Carbon::parse($s->inicio)->format('d/m/Y - H:i') }}
                            <br>
                            <b>F. ENTREGA: </b>
                            {{ \Carbon\Carbon::parse($s->entrega)->format('d/m/Y - H:i') }}
                            <br>
                            <div style="font-size: 7pt">
                                <b>TIPO SERV.: </b>
                                {{ $orden_servicio->type_service }}
                                <br>
                            </div>
                            <b>RESP. TÉCNICO: </b>
                            @if ($s->type == 'PENDIENTE')
                                {{ $s->receiving_technician }}
                            @else
                                {{ $s->responsible_technician }}
                            @endif
                            <br>
                        </div>
                        <hr style="border-color: black; margin-top: 0px; margin-bottom: 1px; margin-left: 5px; margin-right:5px">
                        <table style="font-weight: bold; font-size: 7pt; margin: auto">
                            <tr>
                                <td style="text-align: center;">TOTALES:</td>
                                <td style="text-align: right;">
                                    <b>{{ $s->price_service }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;">A CUENTA:</td>
                                <td style="text-align: right;">
                                    <b>{{ $s->cambio }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;">SALDO:</td>
                                <td style="text-align: right;">
                                    <b>{{ $s->sal }}</b>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 17px;"></td> {{-- espaciador entre columnas --}}
                    {{-- Aqui comienza la segunda columna --}}
                    <td style="width: 15cm">
                             <table width="100%">
                                <tr>
                                    <td width="50%">
                                        <div class="col-sm-6 col-md-6" style="text-align: center; ">
                                            <div class="text-bold"
                                                style="font-size: 15px; margin-top: 0px; margin-bottom: 0px;">
                                                <b>ORDEN DE SERVICIO TÉCNICO<br>{{ $data }}</b>
                                            </div>
                                            <!--<font size="2"><b>Nro.:  </b></font>-->
                                            <span style="font-size: 9px">
                                                {{ \Carbon\Carbon::parse($orden_servicio->created_at)->format('d-m-Y  H:i') }}
                                            </span><br>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <div class="col-sm-6 col-md-6" style="text-align: right ;">
                                            <div class="text-bold" style=" margin-top: 0px; margin-bottom: 0px;">
                                                <u style="font-size: 10px;">Soluciones Informaticas Emanuel
                                                </u></span><br>
                                            </div>
                                            <!--<font size="2"><b>Nro.:  </b></font>-->
                                            <span style="font-size: 8px">
                                                Sucursal:
                                                {{ $sucursal->name }} <br>
                                                {{ $sucursal->adress }} <br>
                                                {{ $sucursal->telefono }}-{{ $sucursal->celular }}
                                            </span><br>
                                        </div>
                                    </td>
                                </tr>
                            </table>        
                        <hr style="border-color: rgb(0, 0, 0); margin: 0px;">
                        <div style=" margin-left: 5px;margin-right:5px;">
                            <div style=" display: flex;">
                                <table>
                                    <tr>
                                        <td style="width: 300px">
                                            <div style="width: auto;">
                                                <b>FECHA:
                                                </b>
                                                {{ \Carbon\Carbon::parse($orden_servicio->created_at)->format('d/m/Y H:i') }}
                                                <br>
                                                <b>CLIENTE: </b> {{ $cliente->nombre }}
                                            </div>
                                        </td>
                                        <td style="width: 100px"></td>

                                        <td style="width: auto;">
                                            <div style="width: auto; display: flex;">
                                                <table id="derechatabla" style="font-weight: bold;">
                                                    <tr>
                                                        <td style="text-align: right;">TOTAL:</td>
                                                        <td style="text-align: right;">
                                                            <b>{{ $s->price_service }}</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: right;">A CUENTA:</td>
                                                        <td style="text-align: right;">
                                                            {{ $s->cambio }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: right;">SALDO:</td>
                                                        <td style="text-align: right;">
                                                            {{ $s->sal }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <hr style="border-color: rgb(0, 0, 0); margin: 0px;">

                            <table>
                                <tr>
                                    <td style="font-size: 10px; width: 10cm">
                                        <b>SERVICIO: </b>{{ $loop->iteration }}&nbsp;&nbsp;<br>
                                        <b>DESCRIPCIÓN:</b>{{ $s->detail }} {{ $s->mark }}<br>
                                        <b>FALLA SEGUN CLIENTE: </b>{{ $s->client_fail }}<br>
                                        <b>DIAGNÓSTICO: </b>{{ $s->diag }}<br>
                                        <b>SOLUCIÓN: </b>{{ $s->servi }}<br>
                                        <b>FECHA ENTREGA APROX.:
                                        </b>{{ \Carbon\Carbon::parse($s->entrega)->format('d/m/Y  H:i') }}<br>
                                        <b>RESPONSABLE TÉCNICO: </b>
                                        @if ($s->type == 'PENDIENTE')
                                            {{ $s->receiving_technician }}
                                        @else
                                            {{ $s->responsible_technician }}
                                        @endif
                                        <br>
                                        <b>ESTADO: </b>
                                        {{ $s->type }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr style="border-color: rgb(0, 0, 0); margin: 0px;">



                        <table width="100%">
                            <tr>

                                <td width="50%" style="  ">
                                    <div class="col-sm-6 col-md-6" style="text-align: left;">
                                        <b style="margin-left:6px">  RESPONSABLE TÉCNICO: </b>
                                        @if ($s->type == 'PENDIENTE')
                                            {{ $s->receiving_technician }}
                                        @else
                                            {{ $s->responsible_technician }}
                                        @endif
                                    </div>
                                </td>
                                <td width="50%">
                        {{-- <table style="font-weight: bold; font-size: 7pt; margin: auto">
                        <table style="font-weight: bold; font-size: 7pt; margin: auto"> --}}
                                    <div class="col-sm-6 col-md-6" style="text-align: right">
                                        <b>CLIENTE:</b>  
                                        {{ $cliente->nombre }}
                                    </div>
                                </td>


                            </tr>


                        </table>

                    
                        <div style="display: flex; font-size: 9px; width: 100%">
                            <div style="text-align:center">
                                @php
                                    $today = date('d-m-Y H:i', time());
                                @endphp

                                CCA: SIS.INF. Soluciones Informaticas Emanuel |
                                {{ \Carbon\Carbon::parse($s->inicio)->format('d/m/Y ') }}
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

        </section>
    @endforeach
</body>

</html>
