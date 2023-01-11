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
        <h6 class="font-weight-bolder mb-0 text-white">Sucursales</h6>
    </nav>
@endsection


@section('empresacollapse')
    nav-link
@endsection


@section('empresaarrow')
    true
@endsection


@section('sucursalesnav')
    "nav-link active"
@endsection


@section('empresashow')
    "collapse show"
@endsection

@section('sucursalesli')
    "nav-item active"
@endsection


<div>

    <div class="card-header pt-0">
        <div class="d-lg-flex">
            <div>
                <h5 class="text-white" style="font-size: 16px">Lista de Sucursales</h5>
            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                    <button wire:click="Agregar()" class="btn btn-add"
                        title="Para crear una nueva sucursal contacte con el administrador">
                        <i class="fas fa-plus me-2">
                        </i>
                        Nueva Sucursal
                    </button>

                    <a href="cajas" type="button" class="btn btn-secondary">
                        Ir a Cajas
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>


                </div>
            </div>
        </div>
    </div>
<br>

    <div class="card">
        <div class="card-body">

            <div class="">
                <div class="col-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <div class="form-group">
                            <h6>Buscar</h6>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search" placeholder="nombre sucursal" class="form-control ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<br>












    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div style="padding-left: 12px; padding-right: 12px;">

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-sm text-center">N°</th>
                                        <th class="text-uppercase text-sm  ps-2">NOMBRE DE LA SUCURSAL</th>
                                        <th class="text-uppercase text-sm  ps-2">DIRECCIÓN
                                        </th>
                                        <th class="text-uppercase text-sm  ps-2">TELÉFONO</th>
                                        <th class="text-uppercase text-sm  ps-2">CELULAR</th>
                                        <th class="text-uppercase text-sm  ps-2">NÚMERO NIT</th>
                                        <th class="text-uppercase text-sm  ps-2">ESTADO</th>
                                        <th class="text-uppercase text-sm  ps-2 text-center">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="text-sm mb-0 text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $item->name }}
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $item->adress }}
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $item->telefono }}
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $item->celular }}
                                            </td>
                                            <td class="text-sm mb-0">
                                                {{ $item->nit_id }}
                                            </td>
                                            <td>
                                                @if ($item->estado == 'ACTIVO')
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        ACTIVO
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger">
                                                        INACTIVO
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-sm mb-0 text-center">

                                                @if ($item->estado == 'ACTIVO')
                                                <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                                    class="mx-3" title="Editar">
                                                    <i class="fas fa-edit text-default" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    wire:click="verificarmovimientos({{ $item->id }})"
                                                    class="mx-3" title="Eliminar">
                                                    <i class="fas fa-trash text-danger" aria-hidden="true"></i>
                                                </a>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{ $data->links() }}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.sucursales.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // window.livewire.on('item-added', msg => {
        //     $('#theModal').modal('hide')
        //     noty(msg)
        // });
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
        // window.livewire.on('item-updated', msg => {
        //     $('#theModal').modal('hide')
        //     noty(msg)
        // });
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
        // window.livewire.on('item-deleted', msg => {
        //     noty(msg)
        // });
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
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });




        window.livewire.on('ConfirmarEliminar', msg => {



            swal({
                title: '¿Confirma eliminar esta sucursal?',
                text: "La sucursal sera eliminada",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Eliminar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRow')
                }
            })

        });

        window.livewire.on('ConfirmarAnular', msg => {


            
            swal({
                title: '¿Inactivar sucursal?',
                text: "La sucursal será inactivada",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Inactivar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('cancelRow')
                }
            })




        });




    });
</script>
