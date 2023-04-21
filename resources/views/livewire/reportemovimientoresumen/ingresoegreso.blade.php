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
                <div class="card-body p-3 py-5 position-relative">
                    <div class="row">
                        <div class="col-12 text-start">
                            <p class="text-sm mb-1 text-uppercase font-weight-bold">BALANCE TOTAL</p>
                            <h5 class="font-weight-bolder mb-0">
                                456.00 Bs
                            </h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body p-3 py-5 position-relative">
                    <div class="row">
                        <div class="col-12 text-start">
                            <p class="text-sm mb-1 text-uppercase font-weight-bold">TOTAL BALANCE</p>
                            <h5 class="font-weight-bolder mb-0">
                                456 Bs
                            </h5>

                        </div>
                    </div>
                </div>
            </div>

            {{-- 
                @foreach ($grouped as $key => $item)
                    <div class="card mx-2">
                        <div class="card-body position-relative">
                            <div class="row">

                                <h6> Caja: {{ $key }}</h6>
                                <h6>
                                    @foreach ($item as $dum)
                                        <div>{{ $dum->carteraNombre }}:{{ $dum->saldocartera }}</div>
                                    @endforeach
                                </h6>
                                <div class="dropdown text-end">
                                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                  
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
        </div>

        <div class="col-4">

            <div class="card">
                <div class="card-body p-3 py-5 position-relative">
                    <div class="row">
                        <div class="col-12 text-start">
                            <p class="text-sm mb-1 text-uppercase font-weight-bold">TOTAL BALANCE</p>
                            <h5 class="font-weight-bolder mb-0">
                                456 Bs
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

                <div class="row justify-content-between">

                    <div class="col-sm-12 col-md-4">
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
                            <label style="font-size: 1rem">Cajas</label>
                            <select wire:model="caja" class="form-select">
                                @foreach ($cajas2 as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                                <option value="TODAS">TODAS</option>
                            </select>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-8">

                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label style="font-size: 1rem">Tipo Movimiento</label>
                            <select wire:model='tipo_movimiento' class="form-select">
                                <option class="text-uppercase text-sm ps-2" value="TODOS">Todos</option>
                                <option class="text-uppercase text-sm ps-2" value="INGRESO">Ingreso</option>
                                <option class="text-uppercase text-sm ps-2" value="EGRESO">Egreso</option>
                                <option class="text-uppercase text-sm ps-2" value="AJUSTE">Ajustes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
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
{{-- 
        <br>
        <div class="card">
            <div class="text-center m-4">
                <div class="row">
                    <div class="col-6">
                        <span class="bg-warning text-white p-2 border-round ">
                            <b>
                                TOTAL Bs. {{ number_format($sumaTotal, 2) }}
                            </b>
                        </span>
                    </div>
                    <div class="col-6">
                        <span class="bg-danger text-white p-2">
                            <b>
                                <b>TOTAL $us. {{ number_format($sumaTotal / $cot_dolar, 2) }}</b>
                            </b>
                        </span>
                    </div>
                </div>
            </div>
        </div> --}}
        <br>
       
    </div>

    <div class="row mt-2 m-1">
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
                                        <p>{{ $loop->iteration }}</p>
                                    </td>
                                    <td>
                                        <p>{{ \Carbon\Carbon::parse($p->movimientoCreacion)->format('d/m/Y') }}
                                            {{ \Carbon\Carbon::parse($p->movimientoCreacion)->format(' H:i') }}</p>
                                    </td>
                                    <td>
                                        <p>
                                            {{ $p->carteramovtype }} {{ $p->nombre }}
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            @if ($p->nombrecategoria != null)
                                                {{ $p->nombrecategoria }}
                                            @else
                                                Sin Categoria
                                            @endif
                                        </p>
                                    </td>
                                    <td style="text-align: right;">
                                        <p>{{ number_format($p->import, 2) }}</p>
                                    </td>
                                    <td>
                                        @if ($p->tipoDeMovimiento == 'SOBRANTE')
                                            <p>SOBRANTE:{{ $p->comentario }}</p>
                                        @elseif($p->tipoDeMovimiento == 'FALTANTE')
                                            <p>FALTANTE:{{ $p->comentario }}</p>
                                        @else
                                            <p>{{ $p->comentario }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        <p>{{ $p->usuarioNombre }}</p>
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
