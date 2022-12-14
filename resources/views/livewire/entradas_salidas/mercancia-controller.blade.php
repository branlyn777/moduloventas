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
        <h6 class="font-weight-bolder mb-0 text-white">Entrada/Salida</h6>
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
                    <h5 class=" text-white" style="font-size: 16px">Entrada y Salida de Productos</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-add mb-0" data-bs-toggle="modal" wire:click='resetui()'
                            data-bs-target="#operacion">
                            <i class="fas fa-plus"></i> Registrar Operación</a>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="padding-left: 12px; padding-right: 12px;">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="mt-lg-0 col-md-6">
                                    <label style="font-size: 1rem">Buscar</label>
                                    <div class="form-group">
                                        <div class="input-group mb-4">
                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                            <input type="text" placeholder="Tipo de Operación, Almacén"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">

                               
                                      
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <label>Fecha Inicio</label>
                                                <div class="form-group">
                                                    <input type="date" wire:model="fromDate" class="form-control">
                                                </div>
                                            </div>
            
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <label>Fecha Fin</label>
                                                <div class="form-group">
                                                    <input type="date" wire:model="toDate" class="form-control">
                                                </div>
                                            </div>
                             
                      
                                        <div class="col-md-6">
                                            <label style="font-size: 1rem">Tipo Operacion</label>
                                            <select wire:model='tipo_de_operacion' class="form-select">
                                                <option value="Entrada">Entrada</option>
                                                <option value="Salida">Salida</option>
                                            </select>
                                        </div>
                             
                                </div>


                            </div>
                       


                       
                       
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card">
                <div class="card-body">
                    
                    <div class="d-lg-flex m-3">
                        <div class="col-12 col-sm-12 col-md-3 mt-2 pt-2">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4 col-md-2">
                            <div class="ms-auto my-auto">
                                <label>Estado</label>
                                <select wire:model='tipo_de_operacion' class="form-select">
                                    <option value="Entrada">Entrada</option>
                                    <option value="Salida">Salida</option>
                                  </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}

            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">N°</th>
                                    <th class="text-uppercase text-sm">Fecha de Registro</th>
                                    <th class="text-uppercase text-sm">Almacén</th>
                                    <th class="text-uppercase text-sm">Tipo Operación</th>
                                    <th class="text-uppercase text-sm">Observación</th>
                                    <th class="text-uppercase text-sm">Usuario</th>
                                    <th class="text-uppercase text-sm text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ingprod as $data2)
                                    <tr style="font-size: 14px">
                                        <td class="text-center">
                                            {{ ($ingprod->currentpage() - 1) * $ingprod->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($data2->created_at)->format('d-m-Y') }}
                                            <br>
                                            {{ \Carbon\Carbon::parse($data2->created_at)->format('h:i:s a') }}
                                        </td>

                                        <td>
                                            Sucursal {{ $data2->destinos->sucursals->name }}
                                            {{ $data2->destinos->nombre }}
                                        </td>
                                        <td class="text-center">
                                            {{ $data2->concepto }}
                                        </td>
                                        <td>
                                            {{ $data2->observacion }}
                                        </td>
                                        <td>
                                            {{ $data2->usuarios->name }}
                                        </td>
                                        <td class="text-center">
                                            <a wire:click="ver({{ $data2->id }})" type="button"
                                                class="text-primary  mx-3">
                                                <i class="fas fa-list"></i>
                                            </a>
                                            <a wire:click="verifySale({{ $data2->id }})" type="button"
                                                class="text-danger mx-3">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $ingprod->links() }}
                    </div>
                </div>
            </div>

    </div>
</div>
</div>
@include('livewire.entradas_salidas.operacion')
@include('livewire.entradas_salidas.buscarproducto')
</div>


@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('product-added', msg => {
                $('#operacion').modal('hide')

            });
            window.livewire.on('show-detail', msg => {
                $('#buscarproducto').modal('show')

            });

            window.livewire.on('venta', event => {
                swal(
                    '¡No se puede eliminar el registro!',
                    'Uno o varios de los productos de este registro ya fueron distribuidos y/o tiene relacion con varios registros del sistema.',
                    'error'
                )
            });

            window.livewire.on('confirmar', event => {

                Swal.fire({
                    title: 'Estas seguro de eliminar este registro?',
                    text: "Esta accion es irreversible",
                    type: 'warning',
                    showCancelButton: true,
                    // confirmButtonColor: '#3085d6',
                    // cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {

                        window.livewire.emit('eliminar_registro');
                        Swal.fire(
                            'Eliminado!',
                            'El registro fue eliminado con exito',
                            'success'
                        )
                    }
                })

            });
            window.livewire.on('confirmarAll', event => {

                Swal.fire({
                    title: 'Estas seguro de eliminar este registro?',
                    text: "Esta accion es irreversible",
                    type: 'warning',
                    showCancelButton: true,
                    // confirmButtonColor: '#3085d6',
                    // cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {

                        window.livewire.emit('eliminar_registro_total');
                        Swal.fire(
                            'Eliminado!',
                            'El registro fue eliminado con exito',
                            'success'
                        )
                    }
                })

            });
            window.livewire.on('stock-insuficiente', event => {

                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    padding: '2em'
                });
                toast({
                    type: 'error',
                    title: 'Stock insuficiente para la salida del producto en esta ubicacion.',
                    padding: '2em',
                })
            });

        })
    </script>
    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection
