<div>
    <div class="row">
        <div class="col-12 text-center">
          <p class="h1"><b>{{ $componentName }} | {{ $pageTitle }}</b></p>
        </div>
    </div>
  
    <div class="row">

        <div class="col-12 col-sm-12 col-md-4">
            @include('common.searchbox')
        </div>

        <div class="col-12 col-sm-12 col-md-4 text-center">
            
        </div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            <button wire:click="Agregar()" type="button" class="boton-azul-g">Nuevo Permiso</button>
        </div>

    </div>
  
      <br>

      <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>NO</th>
                    <th>NOMBRE</th>                                                         
                    <th>AREA</th>                                                         
                    <th>DESCRIPCION</th>                                                         
                    <th>ACCIONES</th>    
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $permiso)
                    <tr>
                        <td class="text-center">
                            {{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}
                        </td>
                        <td>
                            {{ ($permiso->name) }}
                        </td> 
                        <td class="text-center">
                            {{ ($permiso->area) }}
                        </td> 
                        <td>
                            {{ ($permiso->descripcion) }}
                        </td>                           
                        
                        <td class="text-center">
                            <a href="javascript:void(0)" wire:click="Edit({{ $permiso->id }})"
                                class="boton-azul" title="Editar registro">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="Confirm('{{ $permiso->id }}','{{ $permiso->name }}')" 
                                class="boton-rojo" title="Eliminar registro">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

