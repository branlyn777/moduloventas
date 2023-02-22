<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex">
                <div>
                    <h5 class="text-white" style="font-size: 16px">{{ $componentName }} | {{ $pageTitle }}</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
                        <button wire:click="$emit('show-modal')" class="btn btn-add mb-0" data-toggle="modal"
                            data-target="#theModal">AGREGAR</button>
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
                                    @include('common.searchbox')
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
                                    <th class="text-uppercase text-sm ps-2 text-center">NOMBRE</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">ESTADO</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm mb-0 text-center">
                                                {{ $category->nombre }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm mb-0 text-center">
                                                {{ $category->estado }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $category->id }})"
                                                class="btn btn-add mb-0" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                onclick="Confirm('{{ $category->id }}','{{ $category->nombre }}'
                                                ,'{{ $category->servicios->count() }}','{{ $category->subcat->count() }}')"
                                                class="btn btn-add mb-0" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>


        </div>

        @include('livewire.categoria_producto_servicio.form')
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('item-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('item-deleted', Msg => {
            noty(Msg)
        });

    });

    function Confirm(id, name, servicio, subcat) {
        if (servicio > 0 || subcat > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la categoria, ' + name + ' porque tiene ' +
                    ' registros relacionados'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar la categoria ' + '"' + name + '"',
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
