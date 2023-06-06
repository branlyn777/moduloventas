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
        <h6 class="font-weight-bolder mb-0 text-white"> Ventas No Agrupadas </h6>
    </nav>
@endsection


@section('Ventascollapse')
    nav-link
@endsection


@section('Ventasarrow')
    true
@endsection


@section('ventasnoagrupadasnav')
    "nav-link active"
@endsection


@section('Ventasshow')
    "collapse show"
@endsection

@section('ventasnoagrupadasli')
    "nav-item active"
@endsection



<div>
    <div class="row">
        <div class="col-12">

            <div class="card-header pt-0 mb-4">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Productos vendidos</h5>
                    </div>
                </div>
            </div>


            <div class="card mb-4"> <br>
                <div style="padding-left: 15px; padding-right: 15px;">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Buscar
                            </h6>
                            <div class="form-group">
                                <input wire:model="search" type="text" class="form-control"
                                    placeholder="Ingrese Nombre o código">
                            </div>
                        </div>
                        {{-- <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Seleccionar Sucursal
                            </h6>
                            <div class="form-group">
                                <select wire:model="sucursal_id" class="form-select">
                                    @foreach ($listasucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->name }}</option>
                                    @endforeach
                                    <option value="Todos">Todas las Sucursales</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Seleccionar Usuario
                            </h6>
                            <div class="form-group">
                                <select wire:model="user_id" class="form-select">
                                    <option value="Todos" selected>Todos</option>
                                    @foreach ($listausuarios as $u)
                                        <option value="{{ $u->id }}">{{ ucwords(strtolower($u->name)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Categoria
                            </h6>
                            <div class="form-group">
                                <select wire:model="categoria_id" class="form-select">
                                    <option value="Todos" selected>Todos</option>
                                    @foreach ($this->lista_categoria as $c)
                                        <option value="{{ $c->id }}">{{ ucwords(strtolower($c->name)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Fecha Inicio
                            </h6>
                            <div class="form-group">
                                <input type="date" wire:model="dateFrom" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2 text-left mb-3">
                            <h6 class="mb-0">
                                Fecha Fin
                            </h6>
                            <div class="form-group">
                                <input type="date" wire:model="dateTo" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">


                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card mb-4" style="padding-top: 10px;">

                        <div class="table-responsive">
                            <table style="width: 100%">
                                <tr>
                                    <td class="text-center">
                                        <h6>Total Utilidad</h6>
                                        <span class="badge badge-sm bg-warning text-lg">
                                            {{ number_format($this->total_utilidad, 2, ',', '.') }} Bs
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card mb-4" style="padding-top: 10px;">

                        <div class="table-responsive">
                            <table style="width: 100%">
                                <tr>
                                    <td class="text-center">
                                        <h6>Total Ventas</h6>
                                        <span class="badge badge-sm bg-primary text-lg">
                                            <b>{{ number_format($this->total_precio, 2, ',', '.') }} Bs</b>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>

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
                                    <th class="text-uppercase text-sm ps-2 text-left">Codigo</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Producto</th>
                                    {{-- <th class="text-uppercase text-sm ps-2 text-left">Código Producto</th> --}}
                                    <th class="text-uppercase text-sm ps-2 text-left">Cantidad</th>
                                    <th class="text-uppercase text-sm ps-2" style="text-align: right;">Precio</th>
                                    {{-- <th class="text-uppercase text-sm ps-2 text-left">Usuario</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Sucursal</th> --}}
                                    <th class="text-uppercase text-sm ps-2 text-center">Fecha</th>
                                    <th class="text-uppercase text-sm ps-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listaproductos as $l)
                                    <tr>
                                        <td class="text-sm mb-0 text-center">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="text-sm mb-0 text-left">
                                            {{ $l->codigo }}
                                        </td>

                                        <td class="text-sm mb-0">
                                            {{ $l->codigo_producto }} - {{ $l->nombre_producto }}
                                            {{-- <br>
                                            <span class="text-sm text-danger">
                                                Producto Devuelto :: Cantidad 2 :: Dinero Devuelto
                                            </span> --}}
                                        </td>

                                        {{-- <td class="text-sm mb-0 text-left">
                                            {{ $l->codigo_producto }}
                                        </td> --}}

                                        <td class="text-sm mb-0 text-left">
                                            {{ $l->cantidad_vendida }}
                                        </td>

                                        <td class="text-sm mb-0 px-2" style="text-align: right;">
                                            {{ number_format($l->precio_venta, 2, ',', '.') }}
                                        </td>

                                        {{-- <td class="text-sm mb-0 text-left">
                                            {{ $l->nombre_vendedor }}
                                        </td>

                                        <td class="text-sm mb-0 text-left">
                                            {{ $l->nombresucursal }}
                                        </td> --}}

                                        <td class="text-sm mb-0 text-center">
                                            @if ($l->ventareciente > -1)
                                                @if ($l->ventareciente == 1)
                                                    <div style="color: rgb(0, 201, 33);">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            Hace {{ $l->ventareciente }} Minuto
                                                        </p>
                                                    </div>
                                                @else
                                                    <div style="color: rgb(0, 201, 33);">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            Hace {{ $l->ventareciente }} Minutos
                                                        </p>
                                                    </div>
                                                @endif
                                            @endif
                                            {{ \Carbon\Carbon::parse($l->fecha_creacion)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-sm mb-0 px-2">
                                            <a href="javascript:void(0)" wire:click="editsale({{ $l->codigo }})"
                                                class="mx-3" title="Editar Venta">
                                                <i class="fas fa-edit text-default" aria-hidden="true"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                wire:click="crearcomprobante({{ $l->codigo }})" class="mx-3"
                                                title="Crear Comprobante">
                                                <i class="fas fa-print text-success" aria-hidden="true"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                wire:click="confirmaranular({{ $l->codigo }})" class="mx-3"
                                                title="Anular Venta">
                                                <i class="fas fa-trash text-danger" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $listaproductos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //Mostrar alerta de anulacion de venta 
            window.livewire.on('anular-venta', msg => {

                swal({
                    title: '¿Anular la venta con el código "' + @this.codigo + '"?',
                    text: "Atención: esta venta tiene " + @this.cantidad + " productos en total",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Anular Venta',
                    padding: '2em'
                }).then(function(result) {
                    if (result.value) {
                        window.livewire.emit('anularventa', @this.codigo)
                    }
                })
            });
            //Mostrar Mensaje Venta Anulada Exitosamente
            window.livewire.on('sale-cancel-ok', event => {
                swal(
                    '¡Venta ' + @this.codigo + ' anulada exitosamente!',
                    'La venta fue anulada correctamente, todos los cambios hechos en la venta fueron revertidos',
                    'success'
                )
            });
            //Mostrar Mensaje a ocurrido un error en la venta
            window.livewire.on('sale-error', event => {
                swal(
                    'A ocurrido un error al anular la venta',
                    'Detalle del error: ' + @this.message,
                    'error'
                )
            });
            //Crear pdf de Informe técnico de un servicio
            window.livewire.on('crear-comprobante', Msg => {
                var idventa = @this.codigo;
                var ventatotal = 1;
                var totalitems = 1;
                var win = window.open('report/pdf/' + ventatotal + '/' + idventa + '/' + totalitems);
                // Cambiar el foco al nuevo tab (punto opcional)
                // win.focus();
            });
        });
    </script>
@endsection
