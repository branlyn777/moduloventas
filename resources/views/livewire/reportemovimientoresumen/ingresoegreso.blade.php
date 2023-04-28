@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-xs">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-xs text-white"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a></li>
            <li class="breadcrumb-item text-xs text-white active" aria-current="page">Gestion</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Ingresos y Egresos </h6>
    </nav>
@endsection


@section('nuevoingresonav')
    "nav-link active"
@endsection


@section('nuevoingresoli')
    "nav-item active"
@endsection


<div>
    <div class="row mb-3">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Ingresos y Egresos</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        @can('Ver_Generar_Ingreso_Egreso_Boton')
                            <button wire:click.prevent="viewDetails()" class="btn btn-add">
                                <i class="fas fa-arrow-alt-circle-down"></i> <i class="fas fa-arrow-alt-circle-up"></i>
                                Generar
                                Ingreso/Egreso
                            </button>
                            <button wire:click.prevent="ajuste()" class="btn btn-light">
                                <i class="fa-solid fa-wrench"></i>
                                Ajustar Carteras
                            </button>
                            <button wire:click.prevent="generarpdf({{ $data }})" class="btn btn-success mx-0">
                                <i class="fas fa-print"></i> Generar PDF
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">

            <div class="card">
                <div class="card-body p-3 py-4 position-relative">
                    <div class="row">
                        <div class="col text-start">
                            <h6 class="mb-2 text-sm" style="color: rgb(73, 4, 202)">BALANCE TOTAL</h6>
                            <h5 class="font-weight-bolder mb-0">
                                Bs. 456.00
                            </h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body p-3 py-4 position-relative">
                    <div class="row">
                        <div class="col-12 text-start">
                            <h6 class="mb-2 text-sm" style="color: rgb(4, 202, 96)">INGRESOS TOTALES</h6>
                            <h5 class="font-weight-bolder mb-0">
                                Bs. 900.00
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-4">

            <div class="card">
                <div class="card-body p-3 py-4 position-relative">
                    <div class="row">
                        <div class="col-12 text-start">
                            <h5 class="mb-2 text-sm" style="color: rgb(214, 3, 3)">EGRESOS TOTALES</h5>
                            <h5 class="font-weight-bolder mb-0">
                                Bs. 850.00
                            </h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3 m-1">
        <div class="card">
            <div class="card-body">

                <div class="row">

             
                    <div class="col">
                        <div class="form-group">
                            <label style="font-size: 1rem">Carteras</label>
                            <select wire:model="caja" class="form-select">
                                @foreach ($cajas2 as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->carteranombre }}-{{ $item->cajanombre }}</option>
                                @endforeach
                                <option value="TODAS">TODAS</option>
                            </select>

                        </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                            <label style="font-size: 1rem">Tipo Movimiento</label>
                            <select wire:model='tipo_movimiento' class="form-select">
                                <option class="text-uppercase text-xs ps-2" value="TODOS">Todos</option>
                                <option class="text-uppercase text-xs ps-2" value="INGRESO">Ingreso</option>
                                <option class="text-uppercase text-xs ps-2" value="EGRESO">Egreso</option>
                                <option class="text-uppercase text-xs ps-2" value="AJUSTE">Ajustes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label style="font-size: 1rem">Categoria</label>
                            <select wire:model='categoria_id' class="form-select">
                                @if ($tipo_movimiento == 'AJUSTE')
                                    <option value=null>-- --</option>
                                @else
                                    <option value="Todos">Todas las Categorias</option>

                                    @foreach ($categorias as $c)
                                        <option value="{{ $c->id }}">
                                            {{ $c->tipo }} - {{ $c->nombre }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <br>

    </div>

    <div class="row mt-2 m-1">
        <div class="card mb-4">
            <h6 class="mt-3">Historial de Transacciones</h6>
            <div class="row">
                <div class="col">

                    <div class="form-group mt-4">
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                            <input type="text" wire:model="search" placeholder="Buscar..." class="form-control ">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">

                            <div class="form-group">
                                <h7 class="text-xs">Fecha inicial</h7>
                                <input type="date" wire:model="fromDate" class="form-control">
                                @error('fromDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group">
                                <h7 class="text-xs">Fecha final</h7>
                                <input type="date" wire:model="toDate" class="form-control">
                                @error('toDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0 mt-0">
                    <table class="table align-items-center mb-0">

                        <thead>
                            <tr>
                                <th class="col text-uppercase text-xs text-center">#</th>
                                <th class="col text-uppercase text-xs text-center">FECHA</th>
                                <th class="col-3 text-uppercase text-xs ps-2">USUARIO</th>
                                <th class="col text-uppercase text-xs ps-2">ESTADO</th>
                                <th class="text-uppercase text-xs ps-2">MOVIMIENTO</th>
                                <th class="text-uppercase text-xs ps-2">MOTIVO</th>
                                <th class="text-uppercase text-xs ps-2">CATEGORIA</th>
                                <th class="text-uppercase text-xs ps-2">IMPORTE</th>
                                <th class="text-uppercase text-xs text-center">ACC.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $p)
                                <tr>
                                    <td class="text-sm text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-sm text-center">
                                        {{ \Carbon\Carbon::parse($p->movimientoCreacion)->format('d/m/y') }}
                                        <br>
                                        {{ \Carbon\Carbon::parse($p->movimientoCreacion)->format(' H:i:s') }}
                                    </td>

                                    <td class="text-sm">
                                        {{ $p->usuarioNombre }}
                                    </td>

                                    @if ($p->movstatus == 'ACTIVO')
                                        <td>
                                            <span class="badge badge-sm bg-gradient-success">
                                                {{ $p->movstatus }}
                                            </span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-sm bg-gradient-danger">
                                                ANULADO
                                            </span>
                                        </td>
                                    @endif







                                    <td class="text-sm">

                                        {{ $p->carteramovtype }}
                                        <br>{{ $p->nombre }}

                                    </td>
                                    <td class="text-sm">
                                        @if ($p->tipoDeMovimiento == 'SOBRANTE')
                                            SOBRANTE:{{ $p->comentario }}
                                        @elseif($p->tipoDeMovimiento == 'FALTANTE')
                                            FALTANTE:{{ $p->comentario }}
                                        @else
                                            {{ $p->comentario }}
                                        @endif
                                    </td>
                                    <td class="text-sm">

                                        @if ($p->nombrecategoria != null)
                                            {{ $p->nombrecategoria }}
                                        @else
                                            S/Categoria
                                        @endif

                                    </td>
                                    <td style="text-sm text-align: right;">
                                        {{ number_format($p->import, 2) }}
                                    </td>






                                    <td class="text-sm align-middle text-center">
                                        <a href="javascript:void(0)"
                                            wire:click="editarOperacion({{ $p->movid }})"
                                            title="Editar Ingreso/egreso">
                                            <i class="fas fa-edit text-info"></i>
                                        </a>

                                        <a href="javascript:void(0)" href="javascript:void(0)"
                                            onclick="Confirm('{{ $p->movid }}')" title="Anular Ingreso/Egreso">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>





    @include('livewire.reportemovimientoresumen.modalDetails')
    @include('livewire.reportemovimientoresumen.modaleditar')
    @include('livewire.reportemovimientoresumen.modalajuste')
</div>


@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('show-modal', Msg => {
                $('#modal-details').modal('show')
            });
            window.livewire.on('show-ajuste', Msg => {
                $('#modal-ajuste').modal('show')
            });
            window.livewire.on('editar-movimiento', Msg => {
                $('#modal-mov').modal('show')
            });
            window.livewire.on('hide_editar', Msg => {
                $('#modal-mov').modal('hide')
            });
            window.livewire.on('hide-modal', Msg => {
                $('#modal-details').modal('hide')
                noty(Msg)
            });
            window.livewire.on('close-ajuste', Msg => {
                $('#modal-ajuste').modal('hide')

            });

            window.livewire.on('openothertap', Msg => {
                var win = window.open('report/pdfingresos');
                // Cambiar el foco al nuevo tab (punto opcional)
                //win.focus();

            });

            function ConfirmarOperacionSinCorte() {
                swal({
                    title: 'Transaccion sin corte de caja',
                    text: "No ha realizado corte de caja, la transaccion no pertenecera a ninguna caja¿Desea proseguir con la operacion?",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Proseguir',
                    padding: '2em'
                }).then(function(result) {
                    if (result.value) {
                        window.livewire.emit('op_sn_corte')
                    }
                })
            }
        });



        function Confirm(id) {

            Swal.fire({
                title: 'Esta seguro de anular esta operacion?',
                text: "Esta accion es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {

                    window.livewire.emit('eliminar_operacion', id);

                    Swal.fire(
                        'Anulado!',
                        'El registro fue anulado con exito',
                        'success'
                    )
                }
            })

        }
    </script>

    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection
