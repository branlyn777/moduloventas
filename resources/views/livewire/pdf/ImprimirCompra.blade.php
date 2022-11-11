<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Compra</title>
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
                        <span style="font-size: 20px; font-weight:bold;">Compra N° {{$data->id}}</span>
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
                        <b>Nombre Proveedor:</b> {{$data->nombre_prov}}
                   
                </td>
                <td>

                </td>
                {{-- <td style="width: 35%;">
                   
                    <b>Registrado por:</b> {{$nombreusuario->name}}
                </td> --}}
            </tr>
        </table>
    

        <div>
            <table style="width: 100%;">
                <thead class="text-white" style="background: #3d3d3d; color: aliceblue; ">
                    <tr>
                        <th colspan="2">DESCRIPCIÓN</th>
                        <th>PRECIO (Bs)</th>
                        <th>IVA%</th>
                        <th>CANTIDAD</th>
                        <th>IMPORTE (Bs)</th>
                    </tr>
                </thead>
                <tbody style="background-color: rgb(255, 255, 255)">
                    @foreach ($detalle as $item)
                    <tr>
                        <td colspan="2">
                            {{ $item->nombre }}
                        </td>
                        <td style="text-align:right;">
                            {{ number_format($item->precio, 2, ",", ".")}}
                        </td>
                        @if ($item->compra->tipo_doc == 'FACTURA')
                        <td style="text-align:right;">
                            {{ number_format(($item->precio/0.87)*0.13*$item->cantidad, 2) }}
                        </td>
                        
                        @else
                        <td style="text-align:right;">
                            {{ number_format(0, 2) }}
                        </td>
                        @endif
                        <td style="text-align:center;">
                            {{ $item->cantidad }}
                        </td>
                     


                        @if ($item->compra->tipo_doc == 'FACTURA')
                               
                        <td style="text-align:right;">
                            {{ number_format(($item->precio *  $item->cantidad)/0.87, 2, ",", ".")}} Bs
                        </td>
                        @else
                        <td style="text-align:right;">
                            {{ number_format($item->precio *  $item->cantidad, 2, ",", ".")}} Bs
                        </td>
                            
                        @endif



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
                        <td  style="text-align:right;">
                            {{$totaliva}}
                        </td>
                        <td style="text-align:center;">
                            <b>{{$totalitems}}</b>
                        </td> 
                        <td style="text-align:right;">
                            <b>{{ number_format($totales, 2, ",", ".")}} Bs</b>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>