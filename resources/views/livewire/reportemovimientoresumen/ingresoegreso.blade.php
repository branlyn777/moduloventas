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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Gestion</li>
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
    <div class="row">
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
                            <button wire:click.prevent="generarpdf({{ $data }})" class="btn btn-success mx-0">
                                <i class="fas fa-print"></i> Generar PDF
                            </button>
                        @endcan
                    </div>
                </div>
            </div>


            <div class="col-sm-12 col-md-12 d-flex">
                @foreach ($grouped as $key => $item)
                    <div class="card mx-2">
                        <div class="card-body position-relative">
                            <div class="row">

                                <h6> Caja: {{ $key }}</h6>
                                <h6>
                                    @foreach ($item as $dum)
                                        <div>{{ $dum->carteraNombre }}:{{ $dum->monto }}</div>
                                    @endforeach
                                </h6>
                                <div class="dropdown text-end">
                                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{-- <span class="text-xs text-secondary">6 May - 7 May</span> --}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-between">

                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label style="font-size: 1rem">Buscar</label>
                                {{-- <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-gp">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                    <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
                                </div> --}}
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        <input type="text" wire:model="search" placeholder="Buscar"
                                            class="form-control ">
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label style="font-size: 1rem">Fecha inicial</label>
                                <input type="date" wire:model="fromDate" class="form-control">
                                @error('fromDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label style="font-size: 1rem">Fecha final</label>
                                <input type="date" wire:model="toDate" class="form-control">
                                @error('toDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label style="font-size: 1rem">Cajas</label>
                                <select wire:model="caja" class="form-select">
                                    @foreach ($cajas2 as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                    <option value="TODAS">TODAS</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label style="font-size: 1rem">Sucursal</label>
                                <select wire:model="sucursal" class="form-select">
                                    @foreach ($sucursals as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <label style="font-size: 1rem">Categoria</label>
                                <select wire:model='categoria_id' class="form-select">
                                    <option value="Todos">Todas las Categorias</option>
                                    @foreach ($categorias as $c)
                                        <option value="{{ $c->id }}">{{ $c->nombre }} -
                                            {{ $c->tipo }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <br>
            <div class="card">
                <div class="text-center ">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <table>
                            <tr>
                                <td colspan="5">
                                    <h6 style="font-size: 100%">
                                        <b>TOTAL Bs.</b>
                                    </h6>
                                </td>
                                <td colspan="1">
                                    <h6 class="text-left" style="font-size: 100%">
                                        {{ number_format($sumaTotal, 2) }} </h6>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5">
                                    <h6 class="text-right p-l-1" colspan="5" style="font-size: 100%">
                                        <b>TOTAL $us.</b>
                                    </h6>
                                </td>
                                <td colspan="1">
                                    <h6 class="text-left" colspan="5" style="font-size: 100%">
                                        {{ number_format($sumaTotal / $cot_dolar, 2) }} </h6>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <br>
            <div class="card mb-4">

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">

                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">#</th>
                                    <th class="text-uppercase text-sm ps-2">FECHA</th>
                                    <th class="text-uppercase text-sm ps-2">MOVIMIENTO</th>
                                    <th class="text-uppercase text-sm ps-2">CATEGORIA</th>
                                    <th class="text-uppercase text-sm ps-2">CAJA</th>
                                    <th class="text-uppercase text-sm ps-2">CARTERA</th>
                                    <th class="text-uppercase text-sm ps-2">IMPORTE</th>
                                    <th class="text-uppercase text-sm ps-2">MOTIVO</th>
                                    <th class="text-uppercase text-sm ps-2">USUARIO</th>
                                    <th class="text-uppercase text-sm ps-2">ESTADO</th>
                                    <th class="text-uppercase text-sm text-center">ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $p)
                                    <tr>
                                        <td>
                                            <h6 class="text-sm mb-0 text-center" style="font-size: 100%">{{ $loop->iteration }}
                                            </h6>
                                        </td>
                                        <td class="d-flex px-2 py-1">
                                            <h6 class="me-3" style="font-size: 100%">
                                                {{ \Carbon\Carbon::parse($p->movimientoCreacion)->format('d/m/Y H:i') }}
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-left" style="font-size: 100%">
                                                {{ $p->carteramovtype }}</h6>
                                        </td>

                                        <td>
                                            <h6 class="text-left" style="font-size: 100%">
                                                @if ($p->nombrecategoria != null)
                                                    <b>{{ $p->nombrecategoria }}</b>
                                                @else
                                                    Sin Categoria
                                                @endif


                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-left" style="font-size: 100%">
                                                {{ $p->cajaNombre }}
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-left" style="font-size: 100%">{{ $p->nombre }}
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-left" style="font-size: 100%">
                                                {{ number_format($p->import, 2) }}
                                            </h6>
                                        </td>
                                        <td>
                                            @if ($p->tipoDeMovimiento == 'SOBRANTE')
                                                <h6 class="text-left" style="font-size: 100%">
                                                    SOBRANTE:{{ $p->comentario }}
                                                </h6>
                                            @elseif($p->tipoDeMovimiento == 'FALTANTE')
                                                <h6 class="text-left" style="font-size: 100%">
                                                    FALTANTE:{{ $p->comentario }}
                                                </h6>
                                            @else
                                                <h6 class="text-left" style="font-size: 100%">
                                                    {{ $p->comentario }}
                                                </h6>
                                            @endif

                                        </td>

                                        <td>
                                            <h6 class="text-left" style="font-size: 100%">
                                                {{ $p->usuarioNombre }}</h6>
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

                                        @if ($p->movstatus == 'INACTIVO')
                                            <td class="align-middle text-center">

                                                --



                                            </td>
                                        @else
                                            <td class="align-middle text-center">
                                                <a href="javascript:void(0)"
                                                    wire:click="editarOperacion({{ $p->movid }})"
                                                    title="Editar Ingreso/egreso">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>

                                                <a href="javascript:void(0)" href="javascript:void(0)"
                                                    onclick="Confirm('{{ $p->movid }}')"
                                                    title="Anular Ingreso/Egreso">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>


                                            </td>
                                        @endif

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

    </div>
</div>
</div>

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('show-modal', Msg => {
                $('#modal-details').modal('show')
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
