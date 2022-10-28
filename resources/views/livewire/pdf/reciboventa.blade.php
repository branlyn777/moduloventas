<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Venta</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .cajaestilo{
            background-color: #e6e6e6;
            border-radius: 15px;
            border: 1.5px solid #5a5a5a;
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
                <td>
                    <img src="{{ asset('storage/iconos/' . $logoempresa) }}" class="invoice-logo" height="70px">
                </td>
                <td>
                    <center>
                        <span style="font-size: 20px; font-weight:bold;">Comprobante de Venta</span>
                        <p style="font-size: 14px; font-weight:bold;">{{$nombreempresa}}</p>
                    </center>
                </td>
                <td>
                    <p style="font-size: 9px; color: black">{{$datossucursal->nombresucursal}} <br>{{$datossucursal->direccionsucursal}}</p>
                </td>
            </tr>
            <tr>
                <td>
                        Razón Social:{{$datoscliente->razonsocial}}
                        <br>
                        NIT:{{$datoscliente->nit}}
                        <br>
                        Celular:{{$datoscliente->celular}}
                </td>
                <td>
                    Fecha Emisión:{{$fecha}}
                    <br>
                    Cajero: {{$nombreusuario->name}}
                </td>
            </tr>
        </table>
    

        <div>
            <table class="text-center" style="width: 100%;">
                <thead class="text-white" style="background: #3d3d3d; color: aliceblue; ">
                    <tr>
                        <th colspan="2">DESCRIPCIÓN</th>
                        <th>PRECIO (Bs)</th>
                        <th>CANTIDAD</th>
                        <th>IMPORTE (Bs)</th>
                    </tr>
                </thead>
                <tbody style="background-color: rgb(255, 255, 255)">
                    @foreach ($venta as $item)
                    <tr>
                        <td colspan="2">
                            {{ $item->nombre }}
                        </td>
                        <td class="text-right">
                            {{ number_format($item->precio, 2) }}
                        </td>
                        <td class="text-center">
                            {{ $item->cantidad }}
                        </td>
                        <td class="text-right">
                            {{ number_format($item->precio *  $item->cantidad, 2) }} Bs
                        </td>
                    </tr>
                    @endforeach
                    <tr style="background: #e4e0e0 ">
                        <td>
                            <b>TOTALES</b>
                        </td>
                        <td class="text-right">
                            
                        </td>
                        <td class="text-right">
                            
                        </td>
                        <td class="text-center">
                            <b>{{$totalitems}}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($total,2) }} Bs</b>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>