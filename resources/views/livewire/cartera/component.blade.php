<div>
    <div class="d-sm-flex justify-content-between">
        <div></div>
        <div class="nav-wrapper position-relative end-0">
            <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv"
                type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span class="btn-inner--text">Nueva Cartera</button>

            <a href="carteramovcategoria" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv"
                type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Ir a Categoria Movimiento</span>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Carteras | Listado</h6>
                </div>
                <div style="padding-left: 12px; padding-right: 12px;">
                    <div class="col-12 col-sm-12 col-md-4">
                        @include('common.searchbox')
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder">NOMBRE</th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder">DESCRIPCION
                                        </th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder">TIPO</th>
                                        {{-- <th>NÚMERO TELEFONO</th> --}}
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder">CAJA</th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->nombre }}
                                            </td>
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->descripcion }}
                                            </td>
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->tipo }}
                                            </td>
                                            {{-- <td>
                                            {{ $item->telefonoNum }}
                                        </td> --}}
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->caja->nombre }}
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                                    class="mx-3" title="Editar">
                                                    <i class="fas fa-edit text-default" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $item->id }}','{{ $item->nombre }}','{{ $item->movimientos }}')"
                                                    class="mx-3" title="Borrar">
                                                    <i class="fas fa-trash text-default" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="table-5">

        {{ $data->links() }}
    </div>
    @include('livewire.cartera.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('alert', msg => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ya existe una cartera de Tipo "Efectivo" en esta caja'
            })
        });

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

    function Confirm(id, name, movimientos) {
        if (movimientos > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la cartera "' + name + '" porque tiene ' +
                    movimientos + ' transacciones.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la cartera ' + '"' + name + '"?.',
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
