<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movimiento Diario General-Resumen</title>



    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    <style>
        .estilostable {
            width: 100%;
            font-size: 12px;
            border-spacing: 0px;
            color: black;
        }

        .estilostable .tablehead {
            background-color: #dbd4d4;
            font-size: 10px;
        }

        .estilostable2 {
            width: 100%;
            font-size: 9px;
            border-spacing: 0px;
            color: black;
        }

        .estilostable2 .tablehead {
            background-color: white;
        }

        .fnombre {
            border: 0.5px solid rgb(204, 204, 204);
        }

        .filarow {
            border: 0.5px solid rgb(204, 204, 204);
            width: 20px;
            text-align: center;
        }

        .filarowpp {
            border: 0.5px solid rgb(204, 204, 204);
            width: 53px;
            text-align: center;
            font-size: 8px;
        }

        .filarownombre {
            border: 0.5px solid rgb(204, 204, 204);
            width: 150px;
        }

        .filarowx {
            border: 0.5px solid rgb(255, 255, 255);
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body class="row">
    <table class="filarowx">
        <tbody>
            <tr class="filarowx">
                <td rowspan="2">
                    <img src="{{ asset('storage/iconos/' . $logoempresa) }}" height="50">
                </td>
                <td style="text-align: center;">
                    <h4><b>REPORTE DE MOVIMIENTO DIARIO</b></h4>
                </td>
                <td rowspan="2">
                    <img src="{{ asset('storage/blanco.jpg') }}" height="50">
                </td>
            </tr>
            <tr>
                <td class="text-center fuente">
                    {{ $nombreempresa }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <div class="">
        <table class="estilostable">
            <thead>
                <tr class="tablehead">
                    <th class="text-center">FECHA</th>
                    <th class="text-center">DETALLE</th>
                    <th style="text-align: right;">INGRESO(Bs)</th>
                    <th style="text-align: right;">EGRESO(Bs)</th>
                    <th style="text-align: right;">
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            UTILIDAD(Bs)
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($totalesIngresosV as $row)
                    <tr class="fuente">
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($row['movcreacion'])->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-center">
                            {{ $row['idventa'] }} {{ $row['tipoDeMovimiento'] }}
                            {{ $row['ctipo'] == 'CajaFisica' ? 'Efectivo' : $row['ctipo'] }} ({{ $row['nombrecartera'] }})
                        </td>
                        <td style="text-align: right;">
                            {{ $row['importe'] }}
                        </td>
                        <td>

                        </td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td style="text-align: right;">
                                {{ number_format($row['utilidadventa'], 2) }}
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table class="estilostable2">
                                <thead>
                                    <tr>
                                        <td class="fnombre">
                                            Nombre
                                        </td>
                                        <td class="filarowpp">
                                            Precio Original
                                        </td>
                                        <td class="filarow">
                                            Desc/Rec
                                        </td>
                                        <td class="filarowpp">
                                            Precio Venta
                                        </td>
                                        <td class="filarow">
                                            Cantidad
                                        </td>
                                        <td class="filarow">
                                            Total
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($row['detalle'] as $item)
                                        <tr class="">
                                            <td class="filarownombre">
                                                {{-- {{rtrim(mb_strimwidth($item['nombre'], 2, 2, '...', 'UTF-8'))}} --}}
                                                {{-- {{$item['nombre']}} --}}
                                                {{ substr($item['nombre'], 0, 25) }}
                                            </td>
                                            <td class="filarow">
                                                {{ number_format($item['po'], 2) }}
                                            </td>
                                            <td class="filarow">
                                                @if ($item['po'] - $item['pv'] == 0)
                                                    {{ $item['po'] - $item['pv'] }}
                                                @else
                                                    {{ ($item['po'] - $item['pv']) * -1 }}
                                                @endif
                                            </td>
                                            <td class="filarow">
                                                {{ number_format($item['pv'], 2) }}
                                            </td>
                                            <td class="filarow">
                                                {{ $item['cant'] }}
                                            </td>
                                            <td class="filarow">
                                                {{ number_format($item['pv'] * $item['cant'], 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td></td>
                        <td></td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td></td>
                        @endif
                    </tr>
                @endforeach

                
                @foreach ($totalesIngresosIE as $ie)
                    <tr>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($ie['movcreacion'])->format('d/m/Y H:i') }}
                        </td>

                        <td class="text-center">
                            {{ $ie['ctipo'] == 'CajaFisica' ? 'Efectivo' : $ie['ctipo'] }} ({{ $ie['nombrecartera'] }})
                        </td>
                        <td style="text-align: right;">
                            {{-- {{ $ie['importe'] }} --}}
                            {{ number_format($ie['importe'], 2) }}
                        </td>
                        <td>

                        </td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td style="text-align: right;">
                                {{ number_format($ie['importe'], 2) }}
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td class="filarowpp">
                            {{ ucwords(strtolower($ie['coment'])) }}
                        </td>
                        <td></td>
                        <td></td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td></td>
                        @endif
                    </tr>
                @endforeach

                @foreach ($totalesEgresosIE as $st)
                    <tr>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($st['movcreacion'])->format('d/m/Y H:i') }}
                        </td>

                        <td class="text-center">
                            {{ $st['ctipo'] == 'CajaFisica' ? 'Efectivo' : $st['ctipo'] }} ({{ $st['nombrecartera'] }})
                        </td>
                        <td>

                        </td>
                        <td style="text-align: right;">
                            {{ $st['importe'] }}
                        </td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td>

                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td class="filarowpp">
                            {{ ucwords(strtolower($st['coment'])) }}
                        </td>
                        <td></td>
                        <td></td>
                        @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            <td></td>
                        @endif
                    </tr>
                @endforeach
                {{-- <tr>
                    @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                        <td colspan="5" style="border-top: 3px solid #dbd4d4">

                        </td>
                    @else
                        <td colspan="4" style="border-top: 3px solid #dbd4d4">

                        </td>
                    @endif
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;">
                        TOTAL OPERACIONES
                    </td>
                    <td style="text-align: right;">
                        <b>{{ number_format($subtotalesIngresos, 2) }}</b>
                    </td>
                    <td style="text-align: right;">
                        <b>{{ number_format($EgresosTotales, 2) }}</b>
                    </td>
                    @if (@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                        <td style="text-align: right;">
                            <b>{{ number_format($totalutilidadSV, 2) }}</b>
                        </td>
                    @endif
                </tr> --}}
            </tbody>

        </table>

        <br>
        <br>

        <table class="estilostable">
            <thead>
                <tr class="tablehead">
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th style="text-align: right;"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>






        <br>





        <table class="estilostable">
            <tbody>

                <tr style="height: 2rem"></tr>

                <tr class="p-5">
                    <td style="text-align: right;">
                        Total Ingresos
                    </td>
                    <td style="text-align: right;">
                        {{ number_format($totalesIngresosV_suma + $totalesIngresosIE_suma, 2) }}
                    </td>
                </tr>

                <tr class="p-5">
                    <td style="text-align: right;">
                        Total Egresos
                    </td>
                    <td style="text-align: right;">
                        {{ number_format($totalesEgresosIE_suma ?? 0, 2) }}
                    </td>

                </tr>
                <tr class="p-5">
                    <td style="text-align: right;">
                        Saldo Total
                    </td>
                    <td style="text-align: right;">
                        {{ number_format($totalesIngresosV_suma + $totalesIngresosIE_suma - $totalesEgresosIE_suma ?? 0, 2) }}
                    </td>

                </tr>

                <tr class="p-5">
                    <td style="text-align: right;">
                        Operaciones Tigo Money
                    </td>
                    <td style="text-align: right;">
                        {{ number_format($total,2) }}
                    </td>

                </tr>


                <tr class="p-5">
                    <td style="text-align: right;">
                        Apertura Caja
                    </td>
                    <td style="text-align: right;">
                        @if($movimiento != null)
                        {{ number_format($movimiento['import'], 2) }}
                        @endif
                    </td>

                </tr>

                <tr class="p-5">
                    <td style="text-align: right;">
                        Sobrantes
                    </td>
                    <td style="text-align: right;">
                        {{ number_format($sobrante, 2) }}
                    </td>


                </tr>
                <tr class="p-5">
                    <td style="text-align: right;">
                        Faltantes
                    </td>
                    <td style="text-align: right;">
                        {{ number_format($faltante, 2) }}
                    </td>


                </tr>
                <tr class="p-5">
                    <td style="text-align: right;">
                        Saldo al cierre de caja
                    </td>
                    <td style="text-align: right;">
                        Bs. {{ $cierremonto }}
                    </td>

                </tr>

            </tbody>
        </table>




    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <table class="filarowx">
        <tbody>
            <tr class="filarowx">
                <td>

                </td>
                <td class="text-center">
                    <hr
                        style="height: 0.5px;
                    width: 150px;
                    background-color: rgb(0, 0, 0);">
                    Cajero
                </td>
                <td>

                </td>
                <td class="text-center">
                    <hr
                        style="height: 0.5px;
                    width: 150px;
                    background-color: rgb(0, 0, 0);">
                    Revisado por
                </td>
                <td>

                </td>
            </tr>
            {{-- <tr>
                <td class="text-center">
                    Soluciones Informáticas Emanuel
                </td>
            </tr> --}}
        </tbody>
    </table>


</body>

</html>
