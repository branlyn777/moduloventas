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
        <h6 class="font-weight-bolder mb-0 text-white">Comision</h6>
    </nav>
@endsection


@section('tigocollapse')
    nav-link
@endsection


@section('tigoarrow')
    true
@endsection


@section('comisionav')
    "nav-link active"
@endsection


@section('tigoshow')
    "collapse show"
@endsection

@section('comisionli')
    "nav-item active"
@endsection

<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">{{ $componentName }}</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-add mb-0" wire:click="Agregar()">
                            <i class="fas fa-plus"></i> Agregar Comisiones</a>
                    </div>
                </div>

            </div>
            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="padding-left: 12px; padding-right: 12px;">
                        <div class="row justify-content-between">
                            <div class="mt-lg-0 col-md-3">
                                <label style="font-size: 1rem">Buscar</label>
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        <input type="text" wire:model="search" placeholder="Nombre"
                                            class="form-control">
                                    </div>
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
                                    <th class="text-uppercase text-sm ps-2">NOMBRE</th>
                                    <th class="text-uppercase text-sm ps-2">TIPO</th>
                                    <th class="text-uppercase text-sm ps-2">MONTO INICIAL</th>
                                    <th class="text-uppercase text-sm ps-2">MONTO FINAL</th>
                                    <th class="text-uppercase text-sm ps-2">COMISIÓN</th>
                                    <th class="text-uppercase text-sm ps-2">PORCENTAJE</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr class="text-left" style="font-size: 14px">
                                        <td class="text-sm mb-0 text-center">
                                            {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>
                                            {{ $item->nombre }}
                                        </td>
                                        <td>
                                            {{ $item->tipo }}
                                        </td>
                                        <td>
                                            {{ number_format($item->monto_inicial, 2) }}
                                        </td>
                                        <td>
                                            {{ number_format($item->monto_final, 2) }}
                                        </td>
                                        <td>
                                            {{ number_format($item->comision, 2) }}
                                        </td>
                                        <td >

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                style="{{ $item->porcentaje == 'Activo' ? 'color: #29a727' : 'color: #f50707' }}"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-toggle-{{ $item->porcentaje == 'Activo' ? 'right' : 'left' }}">
                                                <rect x="1" y="5" width="22" height="14"
                                                    rx="7" ry="7"></rect>
                                                <circle cx="{{ $item->porcentaje == 'Activo' ? '16' : '8' }}"
                                                    cy="12" r="3">
                                                </circle>
                                            </svg>

                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                                class="mx-3" class="boton-azul" title="Editar Comisión">
                                                <i class="fas fa-edit" style="font-size: 14px"></i>
                                            </a>

                                            <a href="javascript:void(0)"
                                                onclick="Confirm('{{ $item->id }}','{{ $item->nombre }}', {{ $item->relacionados->count() }})"
                                                class="boton-rojo mx-3" title="Eliminar Comisión">
                                                <i class="fas fa-trash text-danger" style="font-size: 14px"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $data->links() }}
        </div>
    </div>
    @include('livewire.comisiones.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide');
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
        
        window.livewire.on('item-updated', Msg => {
            $('#theModal').modal('hide')
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
        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
    });

    function Confirm(id, nombre, transaccions) {
        if (transaccions > 0) {
            swal.fire({
                title: 'PRECAUCION',
                type: 'warning',
                text: 'No se puede eliminar la comisión "' + nombre + '" porque existen ' +
                    transaccions + ' tipos de transacciones "origen - motivo" con esta comisión asignada.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            type: 'warning',
            text: '¿Confirmar eliminar la comisión ' + '"' + nombre + '"?',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            // cancelButtonColor: '#383838',
            // confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
</script>
