<div>
    <div class="d-sm-flex justify-content-between">
        <div></div>
        <div class="nav-wrapper position-relative-right end-0">
            <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv"
                type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Nueva Sucursal</span>
            </button>

            <a href="cajas" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Ir a Cajas</span>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="col-12 col-sm-12 col-md-4">
                    @include('common.searchbox')
                </div>
                <div class="card-header pb-0">
                    <h6>Sucursales | Listado</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr">
                                    <th class="text-uppercase text-xxs font-weight-bolder">NOMBRE DE LA SUCURSAL</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">DIRECCIÓN</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">TELÉFONO</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">CELULAR</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">NÚMERO NIT</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">ACCIONES</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <p class="text-xs mb-0">{{ $item->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs mb-0 text-center">{{ $item->adress }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs mb-0 text-center">{{ $item->telefono }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs mb-0 text-center">{{ $item->celular }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs mb-0 text-center">{{ $item->nit_id }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                                class="mx-3" title="Editar">
                                                <i class="fas fa-user-edit text-info" aria-hidden="true"></i>
                                            </a>
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

    @include('livewire.sucursales.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('item-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('item-deleted', msg => {
            noty(msg)
        });
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
    });

    function Confirm(id, name, cajas, usuarios) {
        if (cajas > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la sucursal "' + name + '" porque tiene ' +
                    cajas + ' cajas.'
            })
            return;
        }
        if (usuarios > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la sucursal "' + name + '" porque tiene ' +
                    usuarios + ' usuarios.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la Sucursal ' + '"' + name + '"?.',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
</script>
