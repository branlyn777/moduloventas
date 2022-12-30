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
        <h6 class="font-weight-bolder mb-0 text-white"> Orden Compra</h6>
    </nav>
@endsection


@section('Comprascollapse')
    nav-link
@endsection


@section('Comprasarrow')
    true
@endsection


@section('ordencompranav')
    "nav-link active"
@endsection


@section('Comprasshow')
    "collapse show"
@endsection

@section('ordencomprali')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Ordenes de Compra</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="detalle_orden_compras" class="btn btn-add btn-sm mb-0"><i
                                    class="fas fa-plus me-2"></i> Registrar Orden</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card p-4">
                <div class="card-body">
                    <div class="padding-left: 12px; padding-right: 12px;">
                        <div class="row justify-content-end">
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

                            <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem;">Estado</label>
                                <div class="">
                                    <select wire:model="estado" class="form-select">
                                        <option value='ACTIVO' selected>Activo</option>
                                        <option value='INACTIVO'>Anulado</option>
                                        <option value='Todos'>Todos</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 7px;">
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
                        </div>



                        @if ($this->fecha == 'fechas')
                            <div class="row justify-content-end">
                                <div class="col-12 col-sm-6 col-md-3 text-center"">
                                    <label style="font-size: 1rem;">Fecha Inicio</label>
                                    <div class="form-group">
                                        <input type="date" wire:model="fromDate" class="form-control flatpickr">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-3 text-center">
                                    <label style="font-size: 1rem;">Fecha Fin</label>
                                    <div class="form-group">
                                        <input type="date" wire:model="toDate" class="form-control flatpickr">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-sm text-center">#</th>
                                            <th class="text-uppercase text-sm" style="width: 50px;">COD.</th>
                                            <th class="text-uppercase text-sm">FECHA</th>
                                            <th class="text-uppercase text-sm">PROVEEDORES</th>
                                            <th class="text-uppercase text-sm">ESTADO</th>
                                            <th class="text-uppercase text-sm">USUARIO</th>
                                            <th class="text-uppercase text-sm">TOTAL</th>
                                            <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_orden_compras as $data)
                                            <tr style="font-size: 14px">
                                                <td class="text-center">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    <h6 style="font-size: 12px"><span
                                                            class="badge bg-secondary">{{ $data->id }}</span></h6>
                                                    {{-- <span badge bg-secondary>{{ $data->id}}</span> --}}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}
                                                    <br>
                                                    {{ \Carbon\Carbon::parse($data->created_at)->format('h:i:s a') }}
                                                </td>
                                                <td>
                                                    <h6 style="font-size: 12px" wire:key="{{ $loop->index }}">
                                                        {{ $data->proveedor->nombre_prov }}</h6>
                                                </td>

                                                @if ($data->status == 'ACTIVO')
                                                    <td>
                                                        <span
                                                            class="badge badge-sm bg-gradient-success">{{ $data->status }}</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="badge text-bg-danger text-white">ANULADO</span>
                                                    </td>
                                                @endif

                                                <td>
                                                    {{ $data->usuario->name }}
                                                </td>
                                                <td>
                                                    {{ $data->importe_total }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="VerDetalleCompra('{{ $data->id }}')"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                            title="Listar orden de compra">
                                                            <i class="fas fa-bars" style="font-size: 14px"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-secondary"
                                                            href="{{ url('OrdenCompra/pdf' . '/' . $data->id) }}"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                            title="Imprimir orden de compra">
                                                            <i class="fas fa-print text-white"
                                                                style="font-size: 14px"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            wire:click="anularOrden('{{ $data->id }}')"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                            title="Anular orden compra">
                                                            <i class="fas fa-minus-circle text-white"
                                                                style="font-size: 14px"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                {{-- <td class="text-center">
                                                        <a href="javascript:void(0)" wire:click= "VerDetalleCompra('{{$data->id}}')" class="mx-3"
                                                            title="Listar orden de compra">
                                                            <i class="fas fa-list" style="font-size: 14px"></i>
                                                        </a>
                                                        <a href="{{ url('OrdenCompra/pdf' . '/' . $data->id)}}" class="mx-3"
                                                            class="btn btn-success p-1" title="Imprimir orden de compra">
                                                            <i class="fas fa-print" style="font-size: 14px"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" wire:click="anularOrden('{{ $data->id }}')" class="mx-3"
                                                            title="Anular orden compra">
                                                            <i class="fas fa-minus-circle text-danger" style="font-size: 14px"></i>
                                                        </a>
                                                    </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot class="text-white text-right">
                                            <tr>
                                                <td colspan="5">
                                                     <h5 class="text-dark">Total Bs.-</h5>
                                                     <h5 class="text-dark">Total $us.-</h5>
                                                </td>
                                                <td>
                                                    <h5 class="text-dark text-center">{{$totales}}</h5>
                                                    <h5 class="text-dark text-center">{{round($totales/6.96,2)}}</h5>
                                                </td>
                                                <td  colspan="4">

                                                </td>
                                            </tr>
                                            
                                        </tfoot> --}}
                                </table><br>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('livewire.ordencompra.verDetalleOrden')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        window.livewire.on('verDetalle', msg => {
            $('#detalleOrden').modal('show')
        });

        window.livewire.on('erroreliminarCompra', msg => {
            swal.fire({
                title: 'ERROR',
                icon: 'warning',
                text: 'La compra no puede ser eliminada por que uno de los items ya ha sido distribuido.'
            })
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

        window.livewire.on('anulacion_compra', msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
    })
</script>
