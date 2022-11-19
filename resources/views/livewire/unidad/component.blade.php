<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h3 class="text-center">
                    <b>UNIDADES</b>
                </h3>
                <ul class="row justify-content-end">
                    
                        <a href="javascript:void(0)" class="boton-azul" data-toggle="modal"
                        data-target="#theModal">Agregar Unidad</a>
                    
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    @include('common.searchbox')

                </div>
            </div>

            <div class="widget-content">
                <div class="table-6">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">ITEM</th>
                                <th class="text-center">NOMBRE</th>                              
                                <th class="text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_unidad as $data)
                                <tr>
                                    <td>
                                        <h6 class="text-center">{{ $data->id }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{ $data->nombre }}</h6>
                                    </td>
                                    
                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click="Edit({{ $data->id }})"
                                            class="boton-azul" title="Editar Unidad">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="Confirm('{{ $data->id }}','{{ $data->nombre }}')" 
                                            class="boton-rojo" title="Eliminar unidad">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data_unidad->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.unidad.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('unidad-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('unidad-updated', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('unidad-deleted', msg => {
            ///
        });
       window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });        
        $('theModal').on('hidden.bs.modal',function(e) {
            $('.er').css('display','none')
        })

    });

    function Confirm(id,nombre) {
     
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar la unidad ' + '"' + nombre + '"',
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