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


@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ventas</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Ventas Agrupadas </h6>
    </nav>
@endsection


@section('Ventascollapse')
    nav-link
@endsection


@section('Ventasarrow')
    true
@endsection


@section('ventasagrupadasnav')
    "nav-link active"
@endsection


@section('Ventasshow')
    "collapse show"
@endsection

@section('ventasagrupadasli')
    "nav-item active"
@endsection




<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pt-0 mb-4">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Lista de Ventas</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">

                            <a href="pos" class="btn btn-secondary" data-type="csv" type="button">
                                <span style="margin-right: 7px;" class="btn-inner--text">Nueva Venta</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>


                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body">
                    <div style="padding-left: 12px; padding-right: 12px;">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 text-left" style="margin-bottom: 7px;">
                                <h6 class="mb-0">Buscar...</h6>
                                <div class="">
                                    <div class="dropdown d-inline">

                                        <div class="input-group">
                                            <span class="input-group-text text-body"><i class="fas fa-search"
                                                    aria-hidden="true"></i></span>
                                            <input type="text" wire:model="search" class="form-control"
                                                placeholder="Buscar por Código...">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            @if (Auth::user()->hasPermissionTo('VentasListaMasFiltros'))
                                {{-- <div class="col-12 col-sm-6 col-md-3 text-left" style="margin-bottom: 7px;">
                                    <h6 class="mb-0">Seleccionar Sucursal</h6>
                                    <select wire:model="sucursal_id" class="form-select">
                                        @foreach ($listasucursales as $sucursal)
                                            <option value="{{ $sucursal->id }}">
                                                {{ $sucursal->name }}
                                            </option>
                                        @endforeach
                                        <option value="Todos">Todas las Sucursales</option>
                                    </select>
                                </div> --}}

                                <div class="col-12 col-sm-6 col-md-3 text-left" style="margin-bottom: 7px;">
                                    <h6 class="mb-0">Seleccionar Usuario</h6>
                                    <select wire:model="user_id" class="form-select">
                                        @foreach ($usuarios as $u)
                                            <option value="{{ $u->id }}">{{ ucwords(strtolower($u->name)) }}
                                            </option>
                                        @endforeach
                                        <option value="Todos" selected>Todos</option>
                                    </select>
                                </div>
                            @else
                                <div class="col-12 col-sm-6 col-md-3 text-left" style="margin-bottom: 7px;">
                                    <h6 class="mb-0">Ventas del Usuario</h6>
                                    <div class="form-control">
                                        {{ Auth::user()->name }}
                                    </div>
                                </div>
                            @endif
                            <div class="col-12 col-sm-6 col-md-3 text-left mb-4" style="margin-bottom: 7px;" >
                                <h6 class="mb-0">Tipo de Fecha</h6>
                                <select wire:model="tipofecha" class="form-select">
                                    <option value="hoy" selected>Hoy</option>
                                    <option value="rango">Rango de Fechas</option>
                                </select>
                            </div>

                        </div>

                        @if ($this->tipofecha != 'hoy')
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3 text-left" style="margin-bottom: 7px;">

                                    <h6 class="mb-0">Fecha Inicio</h6>
                                    <input @if ($tipofecha == 'hoy') disabled @endif type="date"
                                        wire:model="dateFrom" class="form-control">





                                </div>

                                <div class="col-12 col-sm-6 col-md-3 text-left" style="margin-bottom: 7px;">


                                    <h6 class="mb-0">Fecha Fin</h6>
                                    <input @if ($tipofecha == 'hoy') disabled @endif type="date"
                                        wire:model="dateTo" class="form-control">



                                </div>

                                <div class="col-12 col-sm-6 col-md-3 text-left" style="margin-bottom: 7px;">
                                    <h6 class="mb-0">Hora Inicio</h6>
                                    <input @if ($tipofecha == 'hoy') disabled @endif type="time"
                                        wire:model="timeFrom" class="form-control">
                                </div>

                                <div class="col-12 col-sm-6 col-md-3 text-left" style="margin-bottom: 7px;">
                                    <h6 class="mb-0">Hora Fin</h6>
                                    <input @if ($tipofecha == 'hoy') disabled @endif type="time"
                                        wire:model="timeTo" class="form-control">
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">Nº</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">CODIGO</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">FECHA</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">TOTALES BS</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">USUARIO</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">CARTERA</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">SUCURSAL</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">CLIENTE</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">ESTADO</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listaventas as $lv)
                                    <tr class="text-left">
                                        <td class="text-sm mb-0 text-center">
                                            {{ ($listaventas->currentpage() - 1) * $listaventas->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $lv->codigo }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            <h6 class="mb-0 text-sm">
                                                @if ($lv->ventareciente <= 60)
                                                    @if ($lv->ventareciente == 1)
                                                        <div style="color: rgb(0, 201, 33);">
                                                            <b>Hace {{ $lv->ventareciente }} Minuto</b>
                                                        </div>
                                                    @else
                                                        <div style="color: rgb(0, 201, 33);">
                                                            <b>Hace {{ $lv->ventareciente }} Minutos</b>
                                                        </div>
                                                    @endif
                                                @endif
                                            </h6>
                                            {{ \Carbon\Carbon::parse($lv->fechaventa)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            @if ($lv->totaldescuento == 0)
                                                    Descuento Bs {{ $lv->totaldescuento }}
                                                    <br>
                                                @else
                                                    @if ($lv->totaldescuento < 0)
                                                        <div style="color: rgb(250, 12, 12);">
                                                            <b>Descuento Bs
                                                                {{ $lv->totaldescuento }}
                                                            </b>
                                                        </div>
                                                    @else
                                                        <div style="color: #004666;">
                                                            <b>Recargo Bs
                                                                {{ $lv->totaldescuento }}
                                                            </b>
                                                        </div>
                                                    @endif
                                                @endif
                                                <b>Total Bs {{ $lv->totalbs }}</b>
                                                <br>
                                                Cambio Bs {{ $lv->totalcambio }}
                                        </td>
                                        <td class="text-sm mb-0 text-left text-sm">
                                            {{ ucwords(strtolower($lv->nombreusuario)) }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ ucwords(strtolower($lv->nombrecartera)) }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ ucwords(strtolower($lv->nombresucursal)) }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            @foreach ($lv->datoscliente as $c)
                                                    @if ($c->nombrecliente == 'Cliente Anónimo')
                                                        {{ $c->nombrecliente }}
                                                    @else
                                                        {{ $c->cedulacliente }}
                                                        <br>
                                                        <b>{{ $c->nombrecliente }}</b>
                                                        <br>
                                                        {{ $c->celularcliente }}
                                                    @endif
                                                @endforeach
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            @if ($lv->estado == 'PAID')
                                                <p class="text-xs mb-0" style="color: #4894ef;">NORMAL</p>
                                            @else
                                                <p class="text-xs mb-0" style="color: #f3112b;">ANULADO</p>
                                            @endif
                                        </td>
                                        <td class="text-sm ps-0 text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">                                                            
                                                <a href="javascript:void(0)" wire:click="modaldetalle({{ $lv->codigo }})"
                                                    class="mx-3" title="Ver detalles de la venta">
                                                    <i class="fas fa-bars text-warning" aria-hidden="true"></i>
                                                </a>                                            
                                                <a href="javascript:void(0)" wire:click="crearcomprobante({{ $lv->codigo }})"
                                                    class="mx-3" title="Crear Comprobante">
                                                    <i class="fas fa-print text-success" aria-hidden="true"></i>
                                                </a>
                                                @if (Auth::user()->hasPermissionTo('VentasListaMasFiltros'))
                                                    @if ($lv->estado == 'PAID')                                       
                                                        <a href="javascript:void(0)" wire:click="modalcambiarusuario({{ $lv->codigo }})"
                                                            class="mx-3" title="Cambiar Usuario Vendedor">
                                                            <i class="fas fa-user-edit text-primary" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" wire:click="editsale({{ $lv->codigo }})"
                                                            class="mx-3" title="Editar Venta">
                                                            <i class="fas fa-edit text-default" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="ConfirmarAnular({{ $lv->codigo }}, '{{ $lv->nombrecartera }}')"
                                                            class="mx-3" title="Anular Venta">
                                                            <i class="fas fa-trash text-danger" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $listaventas->links() }}
        </div>
    </div>
    @include('livewire.sales.modalcambiarusuario')
    @include('livewire.sales.modaldetalles')
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
                    'Detalle del error: ' + @this.mensaje,
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
                text: "Tipo de Pago: " + nombrecartera +
                    " - Se deshará todos los cambios hechos en esta transacción",
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
