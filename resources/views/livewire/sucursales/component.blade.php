<div>
    <div class="d-sm-flex justify-content-between">
        <div class="col-12 col-sm-12 col-md-4">
            @include('common.searchbox')
        </div>
        <div class="nav-wrapper position-relative end-0">
            <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv"
                type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Nueva Sucursaladsfa</span>
            </button>
        </div>
        <div class="nav-wrapper position-relative end-0">
            <a href="cajas" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Ir a Cajas</span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Sucursales | Listado</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">NOMBRE DE LA
                                        SUCURSAL</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">DIRECCIÓN</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">TELÉFONO</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">CELULAR</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">NÚMERO NIT</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr class="text-center">
                                        <td class="align-middle text-center text-sm">
                                            {{ $item->name }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $item->adress }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $item->telefono }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $item->celular }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ $item->nit_id }}
                                        </td>
                                        <td>
                                            <button wire:click="Edit({{ $item->id }})" class="boton-celeste"
                                                title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
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

<br>



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
