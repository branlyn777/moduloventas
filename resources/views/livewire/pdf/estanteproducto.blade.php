<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle/Estante</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .cajaestilo{
            background-color: #fdfdfd;

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
            <tr class="text-left">
            
                <td colspan="2" style="width: 34%;">
                    <center>
                        <span style="font-size: 20px; font-weight:bold;">Detalle Estante</span>
                        <p style="font-size: 14px; font-weight:bold;">{{$datosucursal->sucursal_nombre}}-{{$datosucursal->destino_nombre}}</p>
                    </center>
                </td>
              
            </tr>
            <tr>
                <td colspan="2">
                        <b>Codigo Mobiliario:</b> {{$codigo}}
                        <br>
                        <b>Descripcion Mobiliario</b> {{$descripcion}}
                        <br>
                </td>
             
            </tr>
        </table>
    

        <div>
            <table style="width: 100%;">
                <thead class="text-white" style="background: #3d3d3d; color: aliceblue; ">
                    <tr>
                        <th colspan="2">Producto</th>
                        <th>Total Almacen</th>
                        <th>Estantes relacionados</th>
                        <th>Cant. Estante</th>
                    </tr>
                </thead>
                <tbody style="background-color: rgb(255, 255, 255)">
                    @foreach ($productos as $item)
                    <tr>
                        <td colspan="2">
                            {{ $item->nombre }}-({{$item->codigo}})
                        </td>
                        <td class="text-center">
                            {{ $item->cantidad, 2}}
                        </td>
                        <td class="text-center">
                           @foreach ($item->otrosestantes as $estante)
                                <li style="margin-left: 5px" >{{$estante->codigo}}</li>
                           @endforeach
                        </td>
                        <td>
                           
                        </td>
                    </tr>
                    @endforeach
            
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>