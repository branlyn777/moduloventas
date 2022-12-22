<div>
    <div class="d-sm-flex justify-content-between">
        <div>

        </div>
        <div class="d-flex">
            <div class="dropdown d-inline">
            </div>
            <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv"
                type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Nuevo Rol</span>
                </a>
            </button>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Roles</h6>
                </div>
                <div style="padding-left: 12px; padding-right: 12px;">

                    <div class="col-12 col-sm-12 col-md-4">
                        @include('common.searchbox')
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-left mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xxs font-weight-bolder text-center">Nº</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder ps-2 text-left">
                                            DESCRIPCION</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder ps-2 text-left">FECHA
                                            CREACION</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder ps-2 text-left">FECHA
                                            ACTUALIZACION</th>
                                        <th class="text-left text-uppercase text-xxs font-weight-bolder">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    @foreach ($data as $rol)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0 ">
                                                    {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-xs text-left font-weight-bold mb-0">{{ $rol->name }}
                                                </p>
                                            </td>

                                            <td class="align-middle text-sm">
                                                <p class="text-xs text-left font-weight-bold mb-0">
                                                    {{ \Carbon\Carbon::parse($rol->created_at)->format('d/m/Y H:i') }}
                                                </p>
                                            </td>

                                            <td class="align-middle text-left ">
                                                <p class="text-xs text-left font-weight-bold mb-0">
                                                    {{ \Carbon\Carbon::parse($rol->updated_at)->format('d/m/Y H:i') }}
                                                </p>
                                            </td>

                                            <td class="align-middle text-left">
                                                <a href="javascript:void(0)"
                                                    wire:click.prevent="Edit('{{ $rol->id }}')" class="mx-3">
                                                    <i class="fas fa-user-edit text-default"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $rol->id }}','{{ $rol->name }}')"
                                                    class="mx-3">
                                                    <i class="fas fa-trash text-default"></i>
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
                'No se puede eliminar el Rol por que tiene registros asociados',
                'info'
            )
        })


    });

    function Confirm(id, name, usuarios) {
        if (usuarios > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar el role "' + name + '" porque hay ' +
                    usuarios + ' usuarios con ese role.'
            })
            return;
        }
        swal({
            title: 'CONFIRMAR',
            text: "Confirmar eliminar el role '" + name + "'",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
            }
        })

    }
</script>
