<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .cajaestilo{
            background-color: #fdfdfd;
            border-radius: 15px;
            border: 1px solid #ffffff;
            padding: 10px;
            text-align:center;
            margin:auto;
        }
    </style>

</head>

<body>

    
    <div class="cajaestilo">
        <table style="width: 100%;">
            <tr class="text-center">
                <td style="width: 34%;">
                    <img src="{{ asset('storage/iconos/' . $logoempresa) }}" height="50px">
                </td>
                <td colspan="2" style="width: 34%; text-align: center;">
                    <b>COTIZACIÓN N° {{$idcotization}}</b>
                </td>
                <td style="width: 33%; text-align: right;">
                    <p style="font-size: 14px;">{{$nombreempresa}}</p>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="text-align: center; font-size: 13px;">
                    <p style="color: black">
                        {{$datossucursal->nombresucursal}}
                        {{$datossucursal->direccionsucursal}}
                    <br>
                    ({{$datossucursal->telefono}} - {{$datossucursal->celular}})
                    </p>
                </td>
            </tr>



            <tr style="font-size: 15px;">
                <td colspan="2">
                    <b>Nombre Cliente:</b>
                    @if($datoscliente->nombre != "Cliente Anónimo")
                    {{$datoscliente->nombre}}
                    @endif
                    <br>
                    <b>Atendido por:</b> {{$nombreusuario}}
                </td>
                <td>

                </td>
                <td style="width: 35%;">
                    <b>Fecha Emisión:</b> {{ \Carbon\Carbon::parse($fechacotizacion)->format('d/m/Y H:i') }}
                    <br>
                    <b>Vigente hasta: </b> {{ \Carbon\Carbon::parse($fechafinalizacion)->format('d/m/Y') }}
                </td>
            </tr>

        </table>



        <div>
            <table style="width: 100%;">
                <thead class="text-white" style="background: #464646; color: aliceblue; ">
                    <tr style="font-size: 13px;">
                        <th>No</th>
                        <th colspan="2">Descripción</th>
                        <th style="width: 60px;">Precio(Bs)</th>
                        <th style="width: 55px;">Cantidad</th>
                        <th style="width: 70px;">Importe(Bs)</th>
                    </tr>
                </thead>
                <tbody style="background-color: rgb(255, 255, 255)">
                    @foreach ($cotization_detalle as $item)
                    <tr style="font-size: 12px;">
                        <td style="text-align:center;">
                            {{$loop->iteration}}
                        </td>
                        <td colspan="2">
                            {{ $item->nombre }}
                        </td>
                        <td style="text-align:right;">
                            {{ number_format($item->precio, 2, ",", ".")}}
                        </td>
                        <td style="text-align:center;">
                            {{ $item->cantidad }}
                        </td>
                        <td style="text-align:right;">
                            {{ number_format($item->precio *  $item->cantidad, 2, ",", ".")}} Bs
                        </td>
                    </tr>
                    @endforeach
                    <tr style="background: #e4e0e0; font-size: 12px;">
                        <td>
                            
                        </td>
                        <td colspan="2">
                            <b>TOTALES</b>
                        </td>
                        <td style="text-align:right;">
                            
                        </td>
                        <td style="text-align:center;">
                            <b>{{$totalitems}}</b>
                        </td>
                        <td style="text-align:right;">
                            <b>{{ number_format($totalbs, 2, ",", ".")}} Bs</b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>