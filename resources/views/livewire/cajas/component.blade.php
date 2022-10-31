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
              <button wire:click="Agregar()" type="button" class="boton-azul-g">Nueva Caja</button>
          </div>
  
      </div>
  
      <br>



      <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>NOMBRE</th>
                    <th>ESTADO</th>
                    <th>SUCURSAL</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            {{ $item->nombre }}
                        </td>
                        <td>
                            {{ $item->estado }}
                        </td>
                        <td>
                            {{ $item->sucursal }}
                        </td>
                        <td class="text-center">
                            <button wire:click="Edit({{ $item->id }})"
                                class="boton-celeste" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button
                                onclick="Confirm('{{ $item->id }}','{{ $item->nombre }}','{{ $item->carteras->count() }}')"
                                class="boton-rojo" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    @include('livewire.cajas.form')
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

    function Confirm(id, name, carteras) {
        if (carteras > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la caja "' + name + '" porque tiene ' +
                    carteras + ' carteras.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la caja ' + '"' + name + '"?.',
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
