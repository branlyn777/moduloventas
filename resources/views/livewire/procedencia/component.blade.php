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
              <button wire:click="Agregar()" type="button" class="boton-azul-g">Nueva Procedencia</button>
          </div>
  
      </div>
  
      <br>



      <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>PROCEDENCIA</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            <h6>{{ $item->procedencia }}</h6>
                        </td>
                        <td>
                            <h6 class="text-center">{{ $item->estado }}</h6>
                        </td>

                        <td class="text-center">
                            <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                class="boton-celeste" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)"
                                onclick="Confirm('{{ $item->id }}','{{ $item->procedencia }}','{{ $item->relacionados }}')"
                                class="boton-rojo" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    @include('livewire.procedencia.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        window.livewire.on('item-added', msg => {
            $('#theModal').modal('hide'),
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
        window.livewire.on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none')
        });
    });

    function Confirm(id, name, items) {
        if (items > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la procedencia, ' + name + ' porque tiene ' +
                    items + ' clientes relacionados'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el prouducto ' + '"' + name + '"',
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
