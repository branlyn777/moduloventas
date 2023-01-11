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
        <h6 class="font-weight-bolder mb-0 text-white">Roles</h6>
    </nav>
@endsection


@section('userscollapse')
    nav-link
@endsection


@section('userarrow')
    true
@endsection


@section('rolnav')
    "nav-link active"
@endsection


@section('usershow')
    "collapse show"
@endsection

@section('rolli')
    "nav-item active"
@endsection




<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Roles</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">

                        
                        <button wire:click="Agregar()" class="btn btn-add mb-0"> <i class="fas fa-plus me-2"></i>
                            Nuevo Usuario</button>

                    </div>
                </div>
            </div>
           





            <br>
            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">





                            <h6>Buscar</h6>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="nombre de rol"
                                        class="form-control ">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <br>
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-left mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">Nº</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Nombre de Rol</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Descripción</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Fecha Creación</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Fecha Actualización</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($data as $rol)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm mb-0 text-center">
                                                {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-sm mb-0 text-left">{{ $rol->name }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-sm mb-0 text-left">
                                                {{ $rol->descripcion == null ? 'S/N' : substr($rol->descripcion, 0, 15) }}
                                            </p>
                                        </td>

                                        <td class="align-middle text-sm">
                                            <p class="text-sm mb-0 text-left">
                                                {{ \Carbon\Carbon::parse($rol->created_at)->format('d/m/Y H:i') }}
                                            </p>
                                        </td>

                                        <td class="align-middle text-left ">
                                            <p class="text-sm mb-0 text-left">
                                                {{ \Carbon\Carbon::parse($rol->updated_at)->format('d/m/Y H:i') }}
                                            </p>
                                        </td>

                                        <td class="text-sm ps-0 text-center">
                                            <a href="javascript:void(0)"
                                                wire:click.prevent="Edit('{{ $rol->id }}')" class="mx-3"
                                                title="Editar rol">
                                                <i class="fas fa-user-edit text-info"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                onclick="Confirm('{{ $rol->id }}','{{ $rol->name }}')"
                                                class="mx-3" title="Eliminar rol">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('livewire.roles.form')
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-update', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('role-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-exists', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('modal-hide', Msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('alerta-rol', Msg => {
            Swal.fire(
                'Atención',
                'El Rol no puede ser eliminado, esta en uso',
                'info'
            )
        })


    });

    function Confirm(id, name, usuarios) {
        if (usuarios > 0) {
            swal.fire({
                title: 'Precaucion',
                icon: 'warning',
                type: 'warning',
                text: 'No se puede eliminar el rol "' + name + '" porque hay ' +
                    usuarios + ' usuarios con ese role.'
            })
            return;
        }
        swal.fire({
            title: 'Confirmar',
            icon: 'warning',
            type: 'warning',
            text: 'Eliminar el rol ' + '"' + name + '"',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
</script>
