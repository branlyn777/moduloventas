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
              <button wire:click="Agregar()" type="button" class="boton-azul-g">Nueva Sucursal</button>
          </div>
  
      </div>
  
      <br>


      <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>NOMBRE DE LA SUCURSAL</th>
                    <th>DIRECCIÓN</th>
                    <th>TELÉFONO</th>
                    <th>CELULAR</th>
                    <th>NÚMERO NIT</th>
                    <th>EMPRESA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="text-center">
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            {{ $item->adress }}
                        </td>
                        <td>
                            {{ $item->telefono }}
                        </td>
                        <td>
                            {{ $item->celular }}
                        </td>
                        <td>
                            {{ $item->nit_id }}
                        </td>
                        <td>
                            {{ $item->company }}
                        </td>
                        <td>
                            <button wire:click="Edit({{ $item->id }})"
                                class="boton-celeste" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="Confirm('{{ $item->id }}','{{ $item->name }}',
                                '{{ $item->cajas->count() }}','{{ $item->usuarios->count() }}')"
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
    @include('livewire.sucursales.form')
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

    function Confirm(id, name, cajas, usuarios) {
        if (cajas > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la sucursal "' + name + '" porque tiene ' +
                    cajas + ' cajas.'
            })
            return;
        }
        if (usuarios > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la sucursal "' + name + '" porque tiene ' +
                    usuarios + ' usuarios.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la Sucursal ' + '"' + name + '"?.',
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
