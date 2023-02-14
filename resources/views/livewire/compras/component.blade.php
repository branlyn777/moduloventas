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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Inventarios</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Lista de Compras </h6>
    </nav>
@endsection


@section('Comprascollapse')
    nav-link
@endsection


@section('Comprasarrow')
    true
@endsection


@section('listacomprasnav')
    "nav-link active"
@endsection


@section('Comprasshow')
    "collapse show"
@endsection

@section('listacomprasli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Lista de Compras</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-add mb-0" href="detalle_compras">
                            Registrar Compra</a>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="padding-left: 12px; padding-right: 12px;">
                        <div class="row justify-content-end">
                            <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem;">Buscar</label><br>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="text" wire:model="search"
                                            placeholder="nro.documento,proveedor,usuario" class="form-control">
                                    </div>
                                    <div class="input-group mb-4">
                                        <select wire:model="tipo_search" class="form-select">
                                            <option value="codigo"> Cod. Compra</option>
                                            <option value="proveedor">Proveedor</option>
                                            <option value="usuario">Usuario</option>
                                            <option value="documento">Documento</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem;">Seleccionar Sucursal</label>
                                <div class="">
                                    <select wire:model="sucursal_id" class="form-select">
                                        @foreach ($listasucursales as $sucursal)
                                            <option value="{{ $sucursal->id }}">{{ $sucursal->name }}</option>
                                        @endforeach
                                        <option value="Todos">Todas las Sucursales</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-2" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem;">Estado</label>
                                <div class="">
                                    <select wire:model="estado" class="form-select">
                                        <option value='ACTIVO' selected>Activo</option>
                                        <option value='INACTIVO'>Anulado</option>
                                        <option value='Todos'>Todos</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-2" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem;">Tipo de Fecha</label>
                                <div class="">
                                    <select wire:model="fecha" class="form-select">
                                        <option value='hoy' selected>Hoy</option>
                                        <option value='ayer'>Ayer</option>
                                        <option value='semana'>Semana</option>
                                        <option value='fechas'>Entre Fechas</option>
                                    </select>
                                </div>
                            </div>

                            @if ($this->fecha != 'hoy' and $this->fecha != 'ayer' and $this->fecha != 'semana')
                                <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
                                    <label>Fecha Inicio</label>
                                    <div class="form-group">
                                        <input type="date" wire:model="fromDate" class="form-control flatpickr">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
                                    <label>Fecha Fin</label>
                                    <div class="form-group">
                                        <input type="date" wire:model="toDate" class="form-control flatpickr">
                                    </div>
                                </div>
                            @endif

                            <div class="col-12 col-sm-6 col-md-2" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem;">Otros</label>
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Ver
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" wire:click="VerComprasProducto()">Compras por
                                                producto</a></li>
                                        <li><a class="dropdown-item" wire:click="VerProductosProveedor()">Productos por
                                                proveedor</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">N°</th>
                                    <th class="text-uppercase text-sm ps-2">COD.</th>
                                    <th class="text-uppercase text-sm ps-2">FECHA</th>
                                    <th class="text-uppercase text-sm ps-2">PROVEEDOR</th>
                                    <th class="text-uppercase text-sm ps-2">DOCUMENTO</th>
                                    <th class="text-uppercase text-sm ps-2">TIPO COMPRA</th>
                                    <th class="text-uppercase text-sm ps-2">TOTAL COMPRA</th>
                                    <th class="text-uppercase text-sm ps-2">ESTADO</th>
                                    <th class="text-uppercase text-sm ps-2">USUARIO</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_compras as $data)
                                    <tr style="font-size: 14px">
                                        <td class="text-center">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>
                                            <label style="font-size: 14px"><span
                                                    class="badge bg-secondary">{{ $data->id }}</span></label>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}
                                            <br>
                                            {{ \Carbon\Carbon::parse($data->created_at)->format('h:i:s a') }}
                                        </td>
                                        {{-- <td>
                                                        <label style="font-size: 12px" wire:key="{{ $loop->index }}">{{ $data->nombre_prov}}</label>
                                                    </td> --}}
                                        <td>
                                            <h6 style="font-size: 12px" wire:key="{{ $loop->index }}">
                                                {{ $data->nombre_prov }}</h6>
                                        </td>
                                        <td>
                                            {{ $data->tipo_doc }}
                                            {{ $data->nro_documento ? $data->nro_documento : 'S/N' }}

                                        </td>
                                        <td>
                                            {{ $data->transaccion }}
                                        </td>
                                        <td>
                                            {{ $data->imp_tot }}
                                        </td>


                                        @if ($data->status == 'ACTIVO')
                                            <td>
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $data->status }}</span>
                                                {{-- <span class="badge badge-success mb-0">{{$data->status}}</span> --}}
                                            </td>
                                        @else
                                            <td class="text-center">
                                                <span class="badge text-bg-danger text-white">ANULADO</span>
                                                {{-- <span class="badge badge-warning mb-0">ANULADO</span> --}}
                                            </td>
                                        @endif
                                        <td>
                                            {{ $data->username }}
                                        </td>


                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="VerDetalleCompra('{{ $data->id }}')"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    title="Ver detalle de compra">
                                                    <i class="fas fa-bars" style="font-size: 14px"></i>
                                                </button>
                                                <button type="button" class="btn btn-success"
                                                    wire:click="editarCompra('{{ $data->id }}')"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    title="Editar">
                                                    <i class="fas fa-edit text-white" style="font-size: 14px"></i>
                                                </button>
                                                <a type="button" class="btn btn-secondary"
                                                    href="{{ url('Compras/pdf' . '/' . $data->id) }}" target="_blank"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    title="Exportar">
                                                    <i class="fas fa-print text-white" style="font-size: 14px"></i>
                                            </a>
                                                <button type="button" class="btn btn-danger"
                                                    wire:click="Confirm('{{ $data->id }}')"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    title="Inactivar">
                                                    <i class="fas fa-minus-circle text-white"
                                                        style="font-size: 14px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot class="text-dark text-right">
                                <tr>
                                    <td colspan="5">

                                    </td>
                                    <td>
                                        <h5 class="text-center" style="font-size: 14.5px">
                                        </h5>
                                        <h5 class="text-center" style="font-size: 14.5px">
                                            </h5>
                                    </td>
                                    <td colspan="4">
                                    </td>
                                </tr>
                            </tfoot> --}}
                        </table><br>
                        <div class="text-center">
                            <h6><b> Total Bs.- {{ $totales }}</b></h6>
                            <h6><b>Total $us.- {{ round($totales / 6.96, 2) }}</b></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.compras.verDetallecompra')
    @include('livewire.compras.compra_producto')
    @include('livewire.compras.producto_proveedor')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('purchase-deleted', msg => {
            noty(msg)
        });
        window.livewire.on('purchase-error', msg => {
            noty(msg)
        });
        window.livewire.on('verDetalle', msg => {
            $('#detalleCompra').modal('show')
        });
        window.livewire.on('comprasproducto', msg => {
            $('#compraprod').modal('show')
        });
        window.livewire.on('productoproveedor', msg => {
            $('#prodprov').modal('show')
        });
        window.livewire.on('erroreliminarCompra', msg => {
            swal.fire({
                title: 'ERROR',
                icon: 'warning',
                text: 'La compra no puede ser eliminada por que uno de los items ya ha sido distribuido.'
            })
        });
        window.livewire.on('opentap', Msg => {

            var win = window.open('Compras/pdf/{id}');
            // Cambiar el foco al nuevo tab (punto opcional)
            // win.focus();

        });
        window.livewire.on('preguntareliminarCompra', msg => {
            //console.log(msg);
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: '¿Esta seguro de anular la compra?',
                showCancelButton: true,
                cancelButtonText: 'Cerrar'

            }).then(function(result) {
                if (result.value) {
                    console.log(msg);
                    window.livewire.emit('deleteRow', msg).Swal.close()
                }
            })
        });
    })
</script>
