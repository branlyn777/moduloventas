@section('css')
    <style>
        .avatar-title {
            align-items: center;
            background-color: #3b76e1;
            color: #fff;
            display: flex;
            font-weight: 500;
            height: 100%;
            justify-content: center;
            width: 100%;
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Inventarios</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white"> Proveedores </h6>
    </nav>
@endsection


@section('Comprascollapse')
    nav-link
@endsection


@section('Comprasarrow')
    true
@endsection


@section('proveedoresnav')
    "nav-link active"
@endsection


@section('Comprasshow')
    "collapse show"
@endsection

@section('proveedoresli')
    "nav-item active"
@endsection




<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px"><b>Proveedores</b></h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
                        <a href="javascript:void(0)" class="btn btn-add mb-0" data-bs-toggle="modal"
                            data-bs-target="#theModal" wire:click="resetUI()">
                            <i class="fas fa-plus me-2"></i> Agregar Proveedor
                        </a>
                    </div>
                </div>

            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="padding-left: 12px; padding-right: 12px;" style="margin-bottom: 7px;">
                        <div class="row justify-content-between">
                            <div class="col-12 col-sm-6 col-md-3">
                                <label style="font-size: 1rem;">Buscar</label>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="Nombre" class="form-control">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3 text-left" style="margin-bottom: 7px;">
                                <label style="font-size: 1rem;">Estado</label>
                                <select wire:model='estados' class="form-select">
                                    <option value="null" disabled>Estado</option>
                                    <option value="ACTIVO">Activo</option>
                                    <option value="INACTIVO">Inactivo</option>
                                    <option value="TODOS">Todos</option>
                                </select>
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
                                    <th class="text-uppercase text-sm ps-2">TELÉFONO</th>
                                    <th class="text-uppercase text-sm ps-2">CORREO</th>
                                    <th class="text-uppercase text-sm ps-2">DIRECCIÓN</th>
                                    <th class="text-uppercase text-sm ps-2">NIT</th>
                                    <th class="text-uppercase text-sm ps-2">ESTADO</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_proveedor as $data)
                                    <tr style="font-size: 14px">
                                        <td class="text-center">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td><img src="{{ asset('storage/proveedores/' . $data->imagen) }}"
                                                alt="proveedor"
                                                class="avatar-sm rounded-circle me-2 m-1" />{{ $data->nombre_prov . ' ' . $data->apellido }}
                                        </td>
                                        <td>{{ $data->telefono ? $data->telefono : 'No definido' }}</td>
                                        <td>{{ $data->correo ? $data->correo : 'No definido' }}</td>
                                        <td>{{ $data->direccion ? $data->direccion : 'No definido' }}</td>
                                        <td>{{ $data->nit ? $data->nit : 'No definido' }}</td>
                                        @if ($data->status == 'ACTIVO')
                                            <td>
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $data->status }}</span>
                                                {{-- <span class="badge badge-success mb-0">{{$data->status}}</span> --}}
                                            </td>
                                        @else
                                            <td>
                                                <span
                                                    class="badge badge-sm bg-gradient-danger">{{ $data->status }}</span>
                                                {{-- <td class="text-center" ><span class="badge badge-danger mb-0">{{$data->status}}</span></td> --}}
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            <div>
                                                <a href="javascript:void(0)" wire:click="Edit({{ $data->id }})"
                                                    class="mx-3" title="Editar proveedor">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $data->id }}','{{ $data->nombre }}',{{ $data->compras->count() }})"
                                                    class="mx-3" title="Eliminar proveedor">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $data_proveedor->links() }}
        </div>
    </div>
    @include('livewire.i_suplier.form')
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('proveedor-added', msg => {
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
        window.livewire.on('proveedor-updated', msg => {
            $('#theModal').modal('hide')
            $("#im").val('');
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
        window.livewire.on('proveedor-deleted', msg => {
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
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
        $('theModal').on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none')
        })

    });

    function Confirm(id, nombre, compras) {


        if (compras != 0) {
            swal.fire({
                title: 'Error',
                type: 'warning',
                text: 'El proveedor' + nombre +
                    ' tiene relacion con otros registros del sistema, no puede ser eliminado',

                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#383838',


            })
        } else {

            swal.fire({
                title: 'CONFIRMAR',
                type: 'warning',
                text: 'Confirmar eliminar la proveedor ' + '"' + nombre + '"',
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

    }
</script>
