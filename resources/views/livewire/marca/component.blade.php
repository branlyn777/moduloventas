<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">MARCAS</h5>
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="javascript:void(0)" class="btn bg-gradient-primary btn-sm mb-0" data-toggle="modal"
                                data-target="#theModal">Agregar Marca</a>
                            </div>
                        </div>    
                    </div>
                    <br>
                    <div class="d-lg-flex">
                        <div class="col-12 col-sm-12 col-md-3">
                            @include('common.searchbox')
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ITEM</th>                                
                                            <th>NOMBRE</th>                                
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($marcas as $data)
                                            <tr  class="text-center">
                                                <td>
                                                    <h6>{{ $loop->index+1 }}</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $data->nombre }}</h6>
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0)" wire:click="Edit({{ $data->id }})"
                                                        class="boton-azul" title="Editar marca">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="Confirm('{{ $data->id }}','{{ $data->nombre }}')" 
                                                        class="boton-rojo" title="Eliminar marca">
                                                        <i class="fas fa-trash"></i>
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
                {{ $marcas->links()}}
            </div>
        </div>
    </div>
    @include('livewire.marca.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('marca-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('marca-updated', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('marca-deleted', msg => {
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
            text: 'Confirmar eliminar la marca ' + '"' + nombre + '"',
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
