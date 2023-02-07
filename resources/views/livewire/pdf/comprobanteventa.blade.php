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
            background-color: #fdfdfd;
            border-radius: 15px;
            border: 1px solid #5a5a5a;
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
                <td style="padding-left: 10px; width: 33%;">
                    <img src="{{ asset('storage/iconos/' . $logoempresa) }}" class="invoice-logo" height="70px">
                </td>
                <td colspan="2" style="width: 34%;">
                    <center>
                        <span style="font-size: 20px; font-weight:bold;">Comprobante N° {{$idventa}}</span>
                        <p style="font-size: 14px; font-weight:bold;">{{$nombreempresa}}</p>
                    </center>
                </td>
                <td style="width: 33%;">
                    <center>
                        <p style="font-size: 15px; color: black"><b>{{$datossucursal->nombresucursal}}</b> <br>{{$datossucursal->direccionsucursal}}</p>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">

                    @if($datoscliente->nombrecliente != "Cliente Anónimo")
                    <b>Nombre Cliente:</b> {{$datoscliente->nombrecliente}}
                    @else
                    <b>Nombre Cliente:</b>
                    @endif

                    
                        <br>
                        @if($datoscliente->nombrecliente != "Cliente Anónimo")
                        <b>CI:</b> {{$datoscliente->cedula}}
                        @else
                        <b>CI:</b>
                        @endif



                        <br>
                </td>
                <td>

                </td>
                <td style="width: 35%;">
                    <b>Fecha Emisión:</b> {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y H:i') }}
                    <br>
                    <b>Atendido por:</b> {{$nombreusuario->name}}
                </td>
            </tr>
        </table>
    

        <div>
            <table style="width: 100%;">
                <thead class="text-white" style="background: #464646; color: aliceblue; ">
                    <tr>
                        <th colspan="2">DESCRIPCIÓN</th>
                        <th style="width: 110px;">PRECIO (Bs)</th>
                        <th style="width: 110px;">CANTIDAD</th>
                        <th style="width: 110px;">IMPORTE (Bs)</th>
                    </tr>
                </thead>
                <tbody style="background-color: rgb(255, 255, 255)">
                    @foreach ($venta as $item)
                    <tr>
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
                    <tr style="background: #e4e0e0 ">
                        <td>
                            <b>TOTALES</b>
                        </td>
                        <td class="text-right">
                            
                        </td>
                        <td  class="text-center">
                            
                        </td>
                        <td style="text-align:center;">
                            <b>{{$totalitems}}</b>
                        </td>
                        <td style="text-align:right;">
                            <b>{{ number_format($total, 2, ",", ".")}} Bs</b>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>