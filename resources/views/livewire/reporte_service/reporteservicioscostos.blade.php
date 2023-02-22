@section('css')

<style>
    	.table-1 {
		width: 100%;/* Anchura de ejemplo */
		overflow: auto;
		}
		.table-1 table {
			border-collapse: separate;
			border-spacing: 0;
			border-left: 0.1px solid #ee761c;
			border-bottom: 0.1px solid #ee761c;
			width: 100%;
		}
		.table-1 table thead {
			position: sticky;
			top: 0;
			z-index: 10;
		}
		.table-1 table thead tr {
		background: #ee761c;
		color: white;
		}
		.table-1 table tbody tr:hover {
			background-color: #bbf7ffa4;
		}
		.table-1 table td {
			border-top: 0.1px solid #ee761c;
			padding-left: 8px;
			padding-right: 8px;
			border-right: 0.1px solid #ee761c;
		}






        /* Estilos para el loading */
    .lds-roller {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        }
        .lds-roller div {
        animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        transform-origin: 40px 40px;
        }
        .lds-roller div:after {
        content: " ";
        display: block;
        position: absolute;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #ee761c;
        margin: -4px 0 0 -4px;
        }
        .lds-roller div:nth-child(1) {
        animation-delay: -0.036s;
        }
        .lds-roller div:nth-child(1):after {
        top: 63px;
        left: 63px;
        }
        .lds-roller div:nth-child(2) {
        animation-delay: -0.072s;
        }
        .lds-roller div:nth-child(2):after {
        top: 68px;
        left: 56px;
        }
        .lds-roller div:nth-child(3) {
        animation-delay: -0.108s;
        }
        .lds-roller div:nth-child(3):after {
        top: 71px;
        left: 48px;
        }
        .lds-roller div:nth-child(4) {
        animation-delay: -0.144s;
        }
        .lds-roller div:nth-child(4):after {
        top: 72px;
        left: 40px;
        }
        .lds-roller div:nth-child(5) {
        animation-delay: -0.18s;
        }
        .lds-roller div:nth-child(5):after {
        top: 71px;
        left: 32px;
        }
        .lds-roller div:nth-child(6) {
        animation-delay: -0.216s;
        }
        .lds-roller div:nth-child(6):after {
        top: 68px;
        left: 24px;
        }
        .lds-roller div:nth-child(7) {
        animation-delay: -0.252s;
        }
        .lds-roller div:nth-child(7):after {
        top: 63px;
        left: 17px;
        }
        .lds-roller div:nth-child(8) {
        animation-delay: -0.288s;
        }
        .lds-roller div:nth-child(8):after {
        top: 56px;
        left: 12px;
        }
        @keyframes lds-roller {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }













        /*Estilos para el Boton Pendiente en la Tabla*/
    .pendienteestilos {
        text-decoration: none !important; 
        background-color: rgb(161, 0, 224);
        
        color: white;
        border-color: rgb(161, 0, 224);
        border-radius: 7px;
        padding-top: 2px;
        padding-bottom: 2px;
        padding-left: 5px;
        padding-right: 5px;
        box-shadow: none;
        border-width: 2px;
        border-style: solid;
        border-color: rgb(161, 0, 224);
        display: inline-block;
    }


    /*Estilos para el Boton Proceso en la Tabla*/
    .procesoestilos {
        text-decoration: none !important; 
        background-color: rgb(100, 100, 100);
        
        color: white; 
        border-color: rgb(100, 100, 100);
        border-radius: 7px;
        padding-top: 2px;
        padding-bottom: 2px;
        padding-left: 5px;
        padding-right: 5px;
        box-shadow: none;
        border-width: 2px;
        border-style: solid;
        border-color: rgb(100, 100, 100);
        display: inline-block;
    }


    /*Estilos para el Boton Terminado en la Tabla*/
    .terminadoestilos {
        text-decoration: none !important; 
        background-color: rgb(224, 146, 0);
        
        color: white;
        border-color: rgb(224, 146, 0);
        border-radius: 7px;
        padding-top: 2px;
        padding-bottom: 2px;
        padding-left: 5px;
        padding-right: 5px;
        box-shadow: none;
        border-width: 2px;
        border-style: solid;
        border-color: rgb(224, 146, 0);
        display: inline-block;
    }


    /*Estilos para el Boton Entregado en la Tabla*/
    .entregadoestilos {
        text-decoration: none !important; 
        background-color: rgb(22, 192, 0);
        color: white !important; 
        cursor: default;
        border:none;
        border-radius: 7px;
        padding-top: 2px;
        padding-bottom: 2px;
        padding-left: 5px;
        padding-right: 5px;
        box-shadow: none;
        border-width: 2px;
        border-style: solid;
        border-color: rgb(22, 192, 0);
        display: inline-block;
    }
</style>

@endsection
<div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4 text-center">

        </div>
        <div class="col-12 col-sm-12 col-md-4 text-center">
            <p class="h1"><b>Reporte Servicios con Costo</b></p>
        </div>
        <div class="col-12 col-sm-12 col-md-4 text-center">

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Seleccionar Sucursal</b>
            <div class="form-group">
                <select wire:model="sucursal_id" class="form-control">
                    @foreach($this->listasucursales as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                    <option value="Todos">Todas las Sucursales</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Fecha Inicio</b>
            <div class="form-group">
                <input type="date" wire:model="dateFrom" class="form-control" >
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Fecha Fin</b>
            <div class="form-group">
                <input type="date" wire:model="dateTo" class="form-control" >
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Estado</b>
            <div class="form-group">
                <select wire:model="estado" class="form-control">
                    <option value="PENDIENTE">PENDIENTE</option>
                    <option value="PROCESO">PROCESO</option>
                    <option value="TERMINADO">TERMINADO</option>
                    <option value="ENTREGADO">ENTREGADO</option>
                    <option value="TODOS">TODOS</option>
                </select>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-12 text-center">
            <h4><b>Total Costo:</b> <b>{{number_format($total_costo, 2, ",", ".")}}</b></h4>
        </div>
    </div>


    <center><div id="preloader_3" wire:loading>
                
            
        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

    
    </div></center>



    <div class="table-1">
        <table>
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Codigo</th>
                    <th>Costo Bs</th>
                    <th>Detalle Costo</th>
                    <th>Equipo</th>
                    <th>Falla Según Cliente</th>
                    <th>Fecha Recepción</th>
                    <th>Fecha Entrega</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lista_servicios as $s)
                <tr>
                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="text-center">
                        <span class="stamp stamp" style="background-color: #1572e8">
                            {{$s->codigo}}
                        </span>
                    </td>
                    <td class="text-right">
                        {{number_format($s->costo_servicio, 2, ",", ".")}}
                    </td>
                    <td>
                        {{$s->detalle_costo}}
                    </td>
                    <td>
                        {{ $s->categoria_servicio }} {{$s->marca_producto}} {{$s->detalle_producto}}
                    </td>
                    <td>
                        {{ $s->falla_segun_cliente }}
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($s->fecha_creacion)->format('d/m/Y H:i') }}
                    </td>
                    <td class="text-center">
                        @if($s->estado_servicio == "ENTREGADO")
                        {{ \Carbon\Carbon::parse($s->fecha_entrega)->format('d/m/Y H:i') }}
                        @else
                        NO ENTREGADO
                        @endif
                    </td>
                    <td class="text-center">
                        

                        @if($s->estado_servicio == "PENDIENTE")
                            <span class="pendienteestilos">
                                {{$s->estado_servicio}}
                            </span>
                        @else
                            @if($s->estado_servicio == "PROCESO")
                                <span class="procesoestilos">
                                    {{$s->estado_servicio}}
                                </span>
                            @else
                                @if($s->estado_servicio == "TERMINADO")
                                    <span class="terminadoestilos">
                                        {{$s->estado_servicio}}
                                    </span>
                                @else
                                    <span class="entregadoestilos">
                                        {{$s->estado_servicio}}
                                    </span>
                                @endif
                            @endif
                        @endif



                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center">
                        <b>Total</b>
                    </td>
                    <td>
                        
                    </td>
                    <td class="text-right">
                        <b>{{number_format($total_costo, 2, ",", ".")}}</b>
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>


</div>
