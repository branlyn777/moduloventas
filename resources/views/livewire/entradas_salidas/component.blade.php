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
        <h6 class="font-weight-bolder mb-0 text-white">Ajuste de Inventarios</h6>
    </nav>
@endsection


@section('Gestionproductoscollapse')
    nav-link
@endsection


@section('Gestionproductosarrow')
    true
@endsection


@section('entradasalidanav')
    "nav-link active"
@endsection


@section('Gestionproductosshow')
    "collapse show"
@endsection

@section('entradasalidali')
    "nav-item active"
@endsection

<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Ajustes de Inventario</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a href="registraroperacion" class="btn btn-add mb-0">
                            <i class="fas fa-plus"></i> Registrar Operación
                        </a>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body p-4 m-1">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">
                            <h6>Buscar</h6>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" placeholder="Almacén, Usuario" wire:model='search'
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row justify-content-end">

                                <div class="col-md-3">
                                    <h6>Fecha Inicio</h6>
                                    <div class="form-group">
                                        <input type="date" wire:model="fromDate" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <h6>Fecha Fin</h6>
                                    <div class="form-group">
                                        <input type="date" wire:model="toDate" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <h6 style="font-size: 1rem">Tipo</h6>
                                    <select wire:model='tipo_de_operacion' class="form-select">
                                        <option value="Ajuste">Ajustes de Inventario</option>
                                        <option value="Inicial">Inventario Inicial</option>
                                        <option value="Varios">Varios:Entradas/Salidas</option>
                                        <option value=null disabled hidden>-- --</option>
                                    </select>
                                </div>
                                @if ($tipo_de_operacion == 'Varios')
                                    <div class="col-md-2">
                                        <h6 style="font-size: 1rem">Operacion</h6>
                                        <select wire:model='op_selected' class="form-select">
                                            <option value=null disabled>Elegir</option>
                                            <option value="entrada">Entrada</option>
                                            <option value="salida">Salida</option>
                                        </select>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                @if ($tipo_de_operacion == null)
                    <div class="row mx-auto my-6">
                        <h6 class="text-sm font-weight-normal"> <i class="fas fa-arrow-pointer"></i> Seleccione el tipo
                            de operacion</h6>
                    </div>
                @else
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-sm text-center">N°</th>
                                        <th class="text-uppercase text-sm ps-2">Fecha</th>
                                        <th class="text-uppercase text-sm ps-2">Almacén</th>
                                        <th class="text-uppercase text-sm ps-2">Tipo Operación</th>

                                        <th class="text-uppercase text-sm ps-2">Usuario</th>
                                        <th class="text-uppercase text-sm text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($operacion != null && $tipo_de_operacion == 'Ajuste')
                                        @foreach ($operacion as $item)
                                            <tr>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                    <br>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('h:i:s a') }}

                                                </td>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ $item->nombre }}
                                                </td>
                                                <td class="text-sm mb-0 text-left">
                                                    Ajuste de Inventario
                                                </td>

                                                <td class="text-sm mb-0 text-left">
                                                    {{ $item->name }}
                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="ver('{{ $item->id }}')"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                            title="Ver detalle de compra">
                                                            <i class="fas fa-bars" style="font-size: 14px"></i>
                                                        </button>
                                                        {{-- <button type="button" class="btn btn-danger"
                                                            wire:click="Confirm('{{ $item->id }}')"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                            title="Anular ajuste">
                                                            <i class="fas fa-minus-circle text-white"
                                                                style="font-size: 14px"></i>
                                                        </button> --}}
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach


                                    @endif
                                    @if ($operacion != null && $tipo_de_operacion == 'Inicial')
                                        @foreach ($operacion as $item)
                                            <tr>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                    <br>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('h:i:s a') }}

                                                </td>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ $item->nombre }}
                                                </td>
                                                <td class="text-sm mb-0 text-left">
                                                    Inventario Inicial
                                                </td>

                                                <td class="text-sm mb-0 text-left">
                                                    {{ $item->name }}
                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="ver('{{ $item->id }}')"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                            title="Ver detalle de compra">
                                                            <i class="fas fa-bars" style="font-size: 14px"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            wire:click="Confirm('{{ $item->id }}')"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                            title="Anular ajuste">
                                                            <i class="fas fa-minus-circle text-white"
                                                                style="font-size: 14px"></i>
                                                        </button>

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach


                                    @endif
                                    @if ($operacion != null && $tipo_de_operacion == 'Varios')
                                        @foreach ($operacion as $item)
                                            <tr>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                    <br>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('h:i:s a') }}

                                                </td>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ $item->nombre }}
                                                </td>
                                                <td class="text-sm mb-0 text-left">
                                                    {{ $item->concepto }}
                                                </td>

                                                <td class="text-sm mb-0 text-left">
                                                    {{ $item->name }}
                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="ver('{{ $item->id }}')"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                            title="Ver detalle de operacion">
                                                            <i class="fas fa-bars" style="font-size: 14px"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger"
                                                        wire:click="Confirm('{{ $item->id }}')"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        title="Anular operacion">
                                                        <i class="fas fa-minus-circle text-white"
                                                            style="font-size: 14px"></i>
                                                    </button>

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach


                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    @include('livewire.entradas_salidas.verdetalle')
</div>



@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('operacion-added', Msg => {
                $('#operacion').modal('hide');
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    padding: '2em'
                });
                toast({
                    type: 'success',
                    title: @this.mensaje_toast,
                    padding: '2em',
                })
            });
            window.livewire.on('show-detail', msg => {
                $('#verdetalle').modal('show')

            });

            window.livewire.on('operacion_fallida', event => {
                swal(
                    '¡No se puede eliminar el registro!',
                    'Uno o varios de los productos de este registro ya fueron distribuidos y/o tiene relacion con varios registros del sistema.',
                    'error'
                )
            });

            window.livewire.on('item-deleted', Msg => {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    padding: '2em'
                });
                toast({
                    type: 'success',
                    title: @this.mensaje_toast,
                    padding: '2em',
                })
            });


            window.livewire.on('confirmareliminacion', event => {

                Swal.fire({
                    title: 'Estas seguro de eliminar este registro?',
                    text: "Esta accion es irreversible y modificara la cantidad de su inventario.",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {

                        window.livewire.emit('eliminar_registro_operacion');
                        Swal.fire(
                            'Eliminado!',
                            'El registro fue eliminado con exito',
                            'success'
                        )
                    }
                })

            });



        })
    </script>
    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection
