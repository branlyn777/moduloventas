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
            </span class="btn-inner--text"> Nuevo Permiso</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Permisos | Listado</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">NO</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">NOMBRE</th>                                                         
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">AREA</th>                                                         
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">DESCRIPCION</th>                                                         
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">ACCIONES</th>    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $permiso)
                                    <tr class="text-center">
                                        <td class="align-middle text-center text-sm">
                                            {{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{ ($permiso->name) }}
                                        </td> 
                                        <td class="align-middle text-center text-sm">
                                            {{ ($permiso->area) }}
                                        </td> 
                                        <td class="align-middle text-center text-sm">
                                            {{ ($permiso->descripcion) }}
                                        </td>                           
                                        
                                        <td class="align-middle text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $permiso->id }})"
                                                class="mx-3" title="Editar registro">
                                                <i class="fas fa-user-edit text-info" aria-hidden="true"></i>
                                            </a>
                                            {{-- <a href="javascript:void(0)" onclick="Confirm('{{ $permiso->id }}','{{ $permiso->name }}')" 
                                                class="boton-rojo" title="Eliminar registro">
                                                <i class="fas fa-trash"></i>
                                            </a> --}}
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

      <div class="table-5">
        
        {{ $data->links() }}
    </div>
    @include('livewire.permisos.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-update', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-exists', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('modal-hide', Msg => {
            $('#theModal').modal('hide')
        })    
        
        


        //Cerrar Ventana Modal Cambiar Usuario Vendedor y Mostrar Toast Cambio Exitosamente
        window.livewire.on('message-toast', msg => {
        const toast = swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        padding: '2em'
        });
        toast({
            type: 'info',
            title: "El permiso no se puede eliminar porque tiene roles asignados a este",
            padding: '2em',
        })
        });




              

    });

    function Confirm(id, name) {
        
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el permiso ' + '"' + name + '"',
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

