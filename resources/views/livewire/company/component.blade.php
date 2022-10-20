<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">

                    {{-- <a href="javascript:void(0)" class="btn btn-warning" wire:click="Agregar()">Agregar</a> --}}

                </ul>
            </div>
            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-hover table table-bordered table-bordered-bd-warning mt-4">
                        <thead class="text-white" style="background: #02b1ce">
                            <tr>
                                <th class="table-th text-withe text-center">NOMBRE DE LA EMPRESA</th>
                                <th class="table-th text-withe text-center">NOMBRE CORTO</th>
                                <th class="table-th text-withe text-center">DIRECCIÓN</th>
                                <th class="table-th text-withe text-center">TELÉFONO</th>
                                <th class="table-th text-withe text-center">NÚMERO NIT</th>
                                <th class="table-th text-withe text-center">LOGO</th>
                                <th class="table-th text-withe text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        <h6 class="text-center">{{ $item->name }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{ $item->shortname }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{ $item->adress }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{ $item->phone }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{ $item->nit_id }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <span>
                                            <img src="{{ asset('storage/iconos/' . $item->image) }}" alt="imagen" width="70px" height="70px">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                            class="btn btn-warning mtmobile" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="Confirm('{{ $item->id }}','{{ $item->name }}',
                                        '{{ $item->relacionados->count() }}')" class="btn btn-warning" title="Borrar">
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
    @include('livewire.company.form')
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

    function Confirm(id, name, cantRelacionados) {
        if (cantRelacionados > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la empresa "' + name + '" porque tiene ' +
                    cantRelacionados + ' sucursales.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la empresa ' + '"' + name + '"?.',
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
