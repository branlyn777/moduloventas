<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pt-0 mb-4">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">{{ $componentName }} | {{ $pageTitle }}</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <button wire:click="$emit('show-modal')" class="btn btn-add mb-0" data-toggle="modal"
                                data-target="#theModal">
                                <i class="fas fa-plus me-2"></i> Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <h6>Buscar</h6>
                                @include('common.searchbox')
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
                                    <th class="text-uppercase text-sm ps-2 text-center">NOMBRE</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">CATEGORÍA</th>
                                    {{-- <th class="table-th text-withe text-center">PRECIO</th> --}}
                                    <th class="text-uppercase text-sm ps-2 text-center">ESTADO</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <h6 class="text-center">{{ $item->name }}</h6>
                                        </td>

                                        {{-- <td>
                                            <h6 class="text-center">{{ $item->price }}</h6>
                                        </td> --}}

                                        <td class="align-middle text-center text-sm">
                                            <h6 class="text-center">{{ $item->categoria }}</h6>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <h6 class="text-center">
                                                {{ $item->status == 'ACTIVE' ? 'ACTIVO' : 'DESACTIVADO' }}</h6>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                                class="btn btn-primary mb-0" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                onclick="Confirm('{{ $item->id }}','{{ $item->name }}')"
                                                class="btn btn-warning mb-0" title="Delete">
                                                <i class="fas fa-trash"></i>
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
        @include('livewire.sub_categoria_producto_servicio.form')
    </div>
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

    function Confirm(id, name) {

        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar el origen ' + '"' + name + '"?.',
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
