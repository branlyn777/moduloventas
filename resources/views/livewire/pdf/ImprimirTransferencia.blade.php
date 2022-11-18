<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Comprobante de Compra</title>
        
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    
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
                        <span style="font-size: 20px; font-weight:bold;">TRANSFERENCIA N° {{$ide}}</span>
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
                <td colspan="2" style="font-size: 0.9rem">
                    Origen de Transferencia:{{$origen}}
                    <br>
                    Destino de Transferencia:{{$destino}}
                    <br>
                   
                </td>
                <td style="font-size: 0.9rem">
                    Fecha de Recepcion:{{ \Carbon\Carbon::parse($fecha)->format('Y-m-d')}}
                    <br>
                   
                </td>
                <td style="font-size: 0.9rem">
                    Responsable de Recepcion: {{$userrecepcion}}
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
                        <th style="width: 3%">Item</th>
                     
                        <th>DESCRIPCIÓN</th>
                        <th style="width: 10%">CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($datalist_destino as $ob)
                        <tr>
                            <td class="text-center">
                               {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                            {{ $ob->producto->nombre }}
                            </td>
                            <td class="text-center">
                             {{ $ob->cantidad }}
                            </td>
                            
                        </tr>
                    @endforeach

                
                </tbody>
                
            </table>

            <div style="margin-top:100px;" >
            
                <table style="width: 100%;">
                    <tr>
                        <td>
                            
                        </td>
                        <td style="border-top: 2px solid #000; width: 1.5rem" colspan="2">
                            RECIBIDO POR
                        </td>
                        <td style="border-top: 2px solid rgb(249, 247, 247); width: 1.5rem" colspan="2">

                        </td>

                        <td style="border-top: 2px solid #000; width: 1.5rem" colspan="2">
                            ENTREGADO POR
                        </td>
                        <td>

                        </td>
                    </tr>
                  
                </table>
             
                
            
             </div>

        </div>
    </div>

















    {{-- <section class="header" style="top: -287px">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="vertical-align: top; padding-top:10px; position:relative;">
                    <img src="{{ asset('storage/icons/' . $logoempresa) }}" alt="" class="invoice-logo" height="70px">
                </td>
                <td class="text-left" colspan="2">
                    <p style="font-size: 20px; font-weight:bold;">{{$nombreempresa}}</p>
                    <span style="font-size: 20px; font-weight:bold;">Transferencia N° 000{{$ide}} </span>
                </td>
               
            </tr>
            <tr style="color: rgb(75, 75, 75)">
                
                <td colspan="2" style="vertical-align: top; padding-top:5px; position:relative;">
                        Origen de Transferencia:{{$origen}}
                        <br>
                        Destino de Transferencia:{{$destino}}
                        <br>
                      
                </td>
                <td style="vertical-align: top; padding-top:5px; position:relative;" colspan="2">
                    Fecha de Recepcion:{{ \Carbon\Carbon::parse($fecha)->format('Y-m-d')}}
                    <br>
                    Responsable de Recepcion: {{$userrecepcion}}
                </td>
            </tr>
        </table>
        
    </section>

    <div style="margin-top: -150px;">
        <br>
        <table class="table table-bordered table-striped mt-1">
            <thead class="text-white" style="background: #e4e0e0 ">
                <tr>
                    <th class="table-th text-left text-dark">Item</th>
                    <th class="table-th text-left text-dark">DESCRIPCIóN</th>
                    <th class="table-th text-center text-dark">CANTIDAD</th>
                </tr>
            </thead>
            <tbody style="background-color: rgb(255, 255, 255)">
                
                    @foreach ($datalist_destino as $ob)
                    <tr>
                        <td>
                            <h6 class="text-center">{{ $loop->iteration }}</h6>
                        </td>
                        <td>
                            <h6 class="text-center">{{ $ob->producto->nombre }}</h6>
                        </td>
                        <td>
                            <h6 class="text-center">{{ $ob->cantidad }}</h6>
                        </td>
                        
                    </tr>
                @endforeach
               
                <br>
                <br>
                <br>
                <br>
                <br>
                
            </tbody>
        </table>
        <div style="margin-top:100px;" >
            
            <table>
                <th colspan="1">

                </th>
                <th style="border-top: 2px solid #000; width: 2rem">
                    Recibido por
                </th>
                <th  colspan="1">

                </th>
                <th style="border-top: 2px solid #000;  width: 2rem">
                    Entregado por
                </th>
                <th>

                </th>
            </table>
         
            
        
         </div>

 


--}}
</div>
</body>

</html> 