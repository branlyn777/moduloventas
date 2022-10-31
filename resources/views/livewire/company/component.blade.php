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
            
          </div>
  
      </div>
  
      <br>



      <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>NOMBRE DE LA EMPRESA</th>
                    <th>NOMBRE CORTO</th>
                    <th>DIRECCIÓN</th>
                    <th>TELÉFONO</th>
                    <th>NÚMERO NIT</th>
                    <th>LOGO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            {{ $item->shortname }}
                        </td>
                        <td>
                            {{ $item->adress }}
                        </td>
                        <td>
                            {{ $item->phone }}
                        </td>
                        <td>
                            {{ $item->nit_id }}
                        </td>
                        <td class="text-center">
                            <span>
                                <img src="{{ asset('storage/iconos/' . $item->image) }}" alt="imagen" width="70px" height="70px">
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                class="boton-celeste" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="Confirm('{{ $item->id }}','{{ $item->name }}',
                            '{{ $item->relacionados->count() }}')" class="boton-rojo" title="Borrar">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    @include('livewire.company.form')
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

    function Confirm(id, name, cantRelacionados) {
        if (cantRelacionados > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la empresa "' + name + '" porque tiene ' +
                    cantRelacionados + ' sucursales.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la empresa ' + '"' + name + '"?.',
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
