<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="row">
                <div class="col-6">
                    <h2>
                        <b>{{ $componentName }} | {{ $pageTitle }}</b>
                    </h2>
                </div>
                <div class="col-6 text-right">
                    <a href="javascript:void(0)" class="btn btn-warning" wire:click="Agregar()">Agregar</a>

                </div>
            </div>
            <br>
            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-hover table table-bordered table-bordered-bd-warning mt-4">
                        <thead class="text-white" style="background: #02b1ce">
                            <tr>
                                <th class="table-th text-withe text-center">NOMBRE DEL MOTIVO</th>
                                <th class="table-th text-withe text-center">TIPO</th>
                                <th class="table-th text-withe text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $motivo)
                                <tr>
                                    <td>
                                        <h6 class="text-center">{{ $motivo->nombre }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{ $motivo->tipo }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click="Edit({{ $motivo->id }})"
                                            class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="Confirm('{{ $motivo->id }}','{{ $motivo->nombre }}',
                                        '{{ $motivo->relacionados->count() }}')" class="btn btn-warning" title="Delete">
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
    @include('livewire.motivo.form')
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

    function Confirm(id, name, cantRelacionados ) {
        if (cantRelacionados > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar el motivo "' + name + '" porque esta asignado a ' 
                + cantRelacionados + '  orígenes.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar el motivo ' + '"' + name + '"?.',
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
