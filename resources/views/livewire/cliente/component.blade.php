<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">

                    <a href="javascript:void(0)" class="btn btn-warning" wire:click="Agregar()">Agregar</a>

                </ul>
            </div>
            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-hover table table-bordered table-bordered-bd-warning mt-4">
                        <thead class="text-white" style="background: #02b1ce">
                            <tr>
                                <th class="table-th text-withe">NOMBRE</th>
                                <th class="table-th text-withe text-center">CÉDULA</th>
                                <th class="table-th text-withe text-center">CELULAR</th>
                                <th class="table-th text-withe text-center">EMAIL</th>
                                <th class="table-th text-withe text-center">FECHA NACIM</th>
                                <th class="table-th text-withe text-center">NIT</th>
                                <th class="table-th text-withe text-center">DIRECCIÓN</th>
                                <th class="table-th text-withe text-center">RAZÓN SOCIAL</th>
                                <th class="table-th text-withe text-center">PROCEDENCIA</th>
                                <th class="table-th text-withe text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $c)
                                <tr>
                                    <td>
                                        <h6>{{ $c->nombre }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-center">{{ $c->cedula }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-center">{{ $c->celular }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-center">{{ $c->email }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-center">
                                            {{$c->fecha_nacim }}
                                        </h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-center">{{ $c->nit }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-center">{{ $c->direccion }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-center">{{ $c->razon_social }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="text-center">{{ $c->procedencia }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click="Edit({{ $c->id }})"
                                            class="btn btn-warning mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a href="javascript:void(0)"
                                            onclick="Confirm('{{ $c->id }}','{{ $c->nombre }}')"
                                            class="btn btn-warning" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
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
    @include('livewire.cliente.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
    });

    function Confirm(id, name) {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el usuario ' + '"' + name + '"',
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
