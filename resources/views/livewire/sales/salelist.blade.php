@section('css')

<style>
    
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
        background: #000000;
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

</style>

@endsection

<div>
    <div class="d-sm-flex justify-content-between">
        <div>
        
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline">
                
                {{-- <a href="javascript:void(0)" class="btn btn-outline-white dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2" aria-expanded="false">
                Filtrar
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" style="">
                    <li><a class="dropdown-item border-radius-md" href="javascript:void(0)">Estado: Activo</a></li>
                    <li><a class="dropdown-item border-radius-md" href="javascript:void(0)">Estado: Inactivo</a></li>
                    <li>
                    <hr class="horizontal dark my-2">
                    </li>
                    <li><a class="dropdown-item border-radius-md text-danger" href="javascript:void(0)">Remover Filtros</a></li>
                </ul> --}}
            </div>
            <a href="{{ url('pos') }}" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Nueva Venta</span> 
            </a>
        </div>
    </div>




    <br>

  
  <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->




        <div class="row">
            
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Lista de Ventas</h6>
                    </div>


                    <div class="row">
                        <div class="align-middle text-center">
                            <div id="preloader_3" wire:loading>
                                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                            </div>
                        </div>
                    </div>

                    <div style="padding-left: 12px; padding-right: 12px;">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 text-center" style="margin-bottom: 7px;">
                        
                                <h6 class="mb-0">Buscar...</h6>
                                <div class="">
                                    <div class="dropdown d-inline">
                        
                                        <div class="input-group">
                                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                            <input type="text" wire:model="search" class="form-control" placeholder="Buscar por Código...">
                                        </div>
                        
                                    </div>
                                </div>
                        
                        
                        
                        
                            </div>
                            @if(Auth::user()->hasPermissionTo('VentasListaMasFiltros'))
                            <div class="col-12 col-sm-6 col-md-3 text-center" style="margin-bottom: 7px;">
                                <h6 class="mb-0">Seleccionar Sucursal</h6>
                                <select wire:model="sucursal_id" class="form-select">
                                    @foreach($listasucursales as $sucursal)
                                    <option value="{{$sucursal->id}}">
                                        {{$sucursal->name}}
                                    </option>
                                    @endforeach
                                    <option value="Todos">Todas las Sucursales</option>
                                </select>
                            </div>
                        
                            <div class="col-12 col-sm-6 col-md-3 text-center" style="margin-bottom: 7px;">
                                <h6 class="mb-0">Seleccionar Usuario</h6>
                                <select wire:model="user_id" class="form-select">
                                    @foreach ($usuarios as $u)
                                    <option value="{{ $u->id }}">{{ ucwords(strtolower($u->name)) }}</option>
                                    @endforeach
                                    <option value="Todos" selected>Todos</option>
                                </select>
                            </div>
                            @else
                            <div class="col-12 col-sm-6 col-md-3 text-center" style="margin-bottom: 7px;">
                                <h6 class="mb-0">Ventas del Usuario</h6>
                                <div class="form-control">
                                    {{Auth::user()->name}}
                                </div>
                            </div>
                            @endif
                            <div class="col-12 col-sm-6 col-md-3 text-center" style="margin-bottom: 7px;">
                                <h6 class="mb-0">Tipo de Fecha</h6>
                                <select wire:model="tipofecha" class="form-select">
                                    <option value="hoy" selected>Hoy</option>
                                    <option value="rango">Rango de Fechas</option>
                                </select>
                            </div>
                            
                        </div>
                          
                        @if($this->tipofecha != "hoy")
                        <div class="row">
                        <div class="col-12 col-sm-6 col-md-3 text-center" style="margin-bottom: 7px;">
                    
                            <h6 class="mb-0">Fecha Inicio</h6>
                            <input @if ($tipofecha == 'hoy') disabled @endif type="date" wire:model="dateFrom" class="form-control" >
                    
                    
                    
                    
                    
                        </div>
                    
                        <div class="col-12 col-sm-6 col-md-3 text-center" style="margin-bottom: 7px;">
                        
                    
                            <h6 class="mb-0">Fecha Fin</h6>
                            <input @if ($tipofecha == 'hoy') disabled @endif type="date" wire:model="dateTo" class="form-control" >
                        
                        
                        
                        </div>
                    
                        <div class="col-12 col-sm-6 col-md-3 text-center" style="margin-bottom: 7px;">
                            <h6 class="mb-0">Hora Inicio</h6>
                            <input @if ($tipofecha == 'hoy') disabled @endif type="time" wire:model="timeFrom" class="form-control" >
                        </div>
                    
                        <div class="col-12 col-sm-6 col-md-3 text-center" style="margin-bottom: 7px;">
                            <h6 class="mb-0">Hora Fin</h6>
                            <input @if ($tipofecha == 'hoy') disabled @endif type="time" wire:model="timeTo" class="form-control" >
                        </div>
                        
                        </div>
                        @endif
                    </div>



                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">#</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder ps-2">CODIGO</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">FECHA</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">TOTALES BS</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">USUARIO</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">CARTERA</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">SUCURSAL</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">CLIENTE</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">ESTADO</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">ACCIONES</th>
                            </tr>
                          </thead>
                          <tbody>
        
        
        
                            @foreach ($listaventas as $lv)
                            <tr>
                                <td class="align-middle text-center">
                                    <p class="text-xs mb-0">
                                        {{ ($listaventas->currentpage()-1) * $listaventas->perpage() + $loop->index + 1 }}
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    {{$lv->codigo}}
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">
                                            @if($lv->ventareciente > -1)
                                                @if($lv->ventareciente == 1)
                                                <div style="color: rgb(0, 201, 33);">
                                                    <b>Hace {{$lv->ventareciente}} Minuto</b>
                                                </div>
                                                @else
                                                <div style="color: rgb(0, 201, 33);">
                                                    <b>Hace {{$lv->ventareciente}} Minutos</b>
                                                </div>
                                                @endif
                                            @endif
                                        </h6>
                                        <p class="text-xs mb-0">{{ \Carbon\Carbon::parse($lv->fechaventa)->format('d/m/Y H:i') }}</p>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs mb-0">
                                        @if($lv->totaldescuento == 0)
                                        Descuento Bs {{$lv->totaldescuento}}
                                        <br>
                                        @else
                                            @if($lv->totaldescuento < 0)
                                            <div style="color: rgb(250, 12, 12);"><b>Descuento Bs {{$lv->totaldescuento}}</b></div>
                                            @else
                                            <div style="color: #002df3;"><b>Recargo Bs {{$lv->totaldescuento}}</b></div>
                                            @endif
                                        @endif
                                        <b>Total Bs {{$lv->totalbs}}</b>
                                        <br>
                                        Cambio Bs {{$lv->totalcambio}}
                                    </p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs mb-0">
                                        {{ ucwords(strtolower($lv->nombreusuario))}}
                                    </p>
                                    

                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs mb-0">
                                        {{ ucwords(strtolower($lv->nombrecartera))}}
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs mb-0">
                                       
                                        {{ ucwords(strtolower($lv->nombresucursal))}}

                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs mb-0">
                                       
                                        @foreach($lv->datoscliente as $c)
                                        @if($c->nombrecliente == "Cliente Anónimo")
                                        {{$c->nombrecliente}}
                                        @else
                                            {{$c->cedulacliente}}
                                            <br>
                                            <b>{{$c->nombrecliente}}</b>
                                            <br>
                                            {{$c->celularcliente}}
                                        @endif
                                    @endforeach

                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    @if($lv->estado == "PAID")
                                        <p class="text-xs mb-0" style="color: #4894ef;">NORMAL</p>
                                    @else
                                        <p class="text-xs mb-0" style="color: #f3112b;">ANULADO</p>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button wire:click="modaldetalle({{ $lv->codigo }})" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" title="Ver detalles de la venta">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                        @if(Auth::user()->hasPermissionTo('VentasListaMasFiltros'))
                                            @if($lv->estado == "PAID")
                                            <a href="#" onclick="ConfirmarAnular({{ $lv->codigo }}, '{{$lv->nombrecartera}}')" class="btn btn-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" title="Anular Venta">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <button wire:click="editsale({{$lv->codigo}})" class="btn btn-success" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" title="Editar Venta">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="modalcambiarusuario({{$lv->codigo}})" class="btn btn-info" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" title="Cambiar Usuario Vendedor">
                                                <i class="fas fa-user-edit"></i>
                                            </button>
                                            @endif
                                        @endif
                                        <button wire:click="crearcomprobante({{$lv->codigo}})" class="btn btn-secondary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" title="Crear Comprobante">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      {{ $listaventas->links() }}
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.sales.modaldetalles')
        @include('livewire.sales.modalcambiarusuario')
</div>
@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        //Mostrar ventana modal detalle venta
        window.livewire.on('modaldetalles-show', msg => {
            $('#detalleventa').modal('show')
        });
        //Mostrar ventana modal cambiar usuario vendedor
        window.livewire.on('modalcambiarusuario-show', msg => {
            $('#modalcambiarusuario').modal('show')
        });
        //Mostrar Mensaje Venta Anulada Exitosamente
        window.livewire.on('sale-cancel-ok', event => {
        swal(
            '¡Venta ' + @this.venta_id + ' anulada exitosamente!',
            'La venta fue anulada correctamente, todos los cambios hechos en la venta fueron revertidos',
            'success'
            )
        });
        //Mostrar Mensaje a ocurrido un error en la venta
        window.livewire.on('sale-error', event => {
        swal(
            'A ocurrido un error al anular la venta',
            'Detalle del error: '+ @this.mensaje,
            'error'
            )
        });

        //Cerrar Ventana Modal Cambiar Usuario Vendedor y Mostrar Toast Cambio Exitosamente
        window.livewire.on('modalcambiarusuario-hide', msg => {
                        $('#modalcambiarusuario').modal('hide')
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje,
                padding: '2em',
            })
        });

        //Crear pdf de Informe técnico de un servicio
        window.livewire.on('crear-comprobante', Msg => {
            var idventa = @this.venta_id;
            var ventatotal = @this.venta.total;
            var totalitems = @this.totalitems;
            var win = window.open('report/pdf/' + ventatotal + '/' + idventa + '/' + totalitems);
            // Cambiar el foco al nuevo tab (punto opcional)
            // win.focus();
        });
    });












    // Código para lanzar la Alerta de Anulación de Venta
    function ConfirmarAnular(codigo, nombrecartera) {
    swal({
        title: '¿Anular la venta con el código "' + codigo + '"?',
        text: "Tipo de Pago: " + nombrecartera + " - Se deshará todos los cambios hechos en esta transacción",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Anular Venta',
        padding: '2em'
        }).then(function(result) {
        if (result.value) {
            window.livewire.emit('anularventa', codigo)
            }
        })
    }


</script>
@endsection