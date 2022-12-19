<div>
    <div class="d-sm-flex justify-content-between">
        <div>

        </div>
        {{-- <div class="d-flex">
            <div class="dropdown d-inline">
            </div>
                <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" 
                type="button">
                    <span class="btn-inner--icon">
                        <i class="ni ni-fat-add"></i>
                    </span>
                    <span class="btn-inner--text">Nuevo Permiso</span> 
            </a>
        </div> --}}
      </div>

      <br>

    <div class="row">
        <div class="col-12 ">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista Permisos </h6>
                </div>
                <div style="padding-left: 12px; padding-right: 12px;">

                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search" placeholder="Buscar Nombre o Area de Permiso" class="form-control ">
                            </div>
                        </div>
                        
                    </div>             
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="text-left">
                                        <th class="text-sm mb-0 text-center">NO</th>
                                        <th class="text-sm mb-0 text-center">NOMBRE</th>                                                         
                                        <th class="text-sm mb-0 text-center">AREA</th>                                                         
                                        <th class="text-sm mb-0 text-center">DESCRIPCION</th>                                                         
                                        <th class="text-sm mb-0 text-center ">ACCIONES</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $permiso)
                                        <tr class="text-left">
                                            <td class="text-sm mb-0 text-center">
                                                {{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}
                                            </td>
                                            <td class="text-sm mb-0 text-center">
                                                {{ ($permiso->name) }}
                                            </td> 
                                            <td class="text-sm mb-0 text-center">
                                                {{ ($permiso->area) }}
                                            </td> 
                                            <td class="text-sm mb-0 text-center">
                                                {{ ($permiso->descripcion) }}
                                            </td>                           
                                            
                                            <td class="align-middle text-center">
                                                <a href="javascript:void(0)" wire:click="Edit({{ $permiso->id }})"
                                                    class="text-center" title="Editar registro">
                                                    <i class="fas fa-edit text-deafult" aria-hidden="true"></i>
                                                </a>
                                                {{-- <a href="javascript:void(0)" onclick="Confirm('{{ $permiso->id }}','{{ $permiso->name }}')" 
                                                    class="boton-rojo" title="Eliminar registro">
                                                    <i class="fas fa-trash text-danger"></i>
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

