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
              <button wire:click="Agregar()" type="button" class="boton-azul-g">Nueva Cartera</button>
          </div>
  
      </div>
  
      <br>



      <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>TIPO</th>
                    <th>NÚMERO TELEFONO</th>
                    <th>CAJA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="text-center">
                        <td>
                            {{ $item->nombre }}
                        </td>
                        <td>
                            {{ $item->descripcion }}
                        </td>
                        <td>
                            {{ $item->tipo }}
                        </td>
                        <td>
                            {{ $item->telefonoNum }}
                        </td>
                        <td>
                            {{ $item->caja->nombre }}
                        </td>
                        <td class="text-center">
                            <button wire:click="Edit({{ $item->id }})"
                                class="boton-celeste" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button
                                onclick="Confirm('{{ $item->id }}','{{ $item->nombre }}','{{ $item->movimientos }}')"
                                class="boton-rojo" title="Borrar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    @include('livewire.cartera.form')
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

    function Confirm(id, name, movimientos) {
        if (movimientos > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la cartera "' + name + '" porque tiene ' +
                    movimientos + ' transacciones.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la cartera ' + '"' + name + '"?.',
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
