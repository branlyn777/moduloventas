

<div>
    <div class="d-sm-flex justify-content-between">
      <div>

      </div>
        <div class="nav-wrapper position-relative end-0">
            <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" 
            type="button">
            <span class="btn-inner--icon">
                <i class="ni ni-fat-add"></i>
            </span class="btn-inner--text"> Nuevo Procedencia</button>

              <a href="clientes" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Ir a Clientes</span>
            </a>
            
        </div>
     </div>
     
     <br>

      <div class="row">
          <div class="col-12">
              <div class="card mb-4">
                  <div class="card-header pb-0">
                    <h6>Procedencias | Listado</h6>
                  </div>
                  <div style="padding-left: 12px; padding-right: 12px;">

                    <div class="col-12 col-sm-12 col-md-4">
                      @include('common.searchbox')
                  </div>

                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-xxs font-weight-bolder">PROCEDENCIA</th>
                              <th class="text-uppercase text-xxs font-weight-bolder ps-2">ESTADO</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">ACCIONES</th>
                            </tr>
                          </thead>
                          <tbody>
  
                            @foreach ($data as $item)
                            <tr>
                              <td>
                                <p class="text-xs font-weight-bold mb-0 ">{{ $item->procedencia }}</p>
                              </td>
  
                              <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $item->estado }}</p>
                              </td>                         
  
                              <td class="align-middle text-center">
                                  <a href="javascript:void(0)" wire:click.prevent="Edit('{{ $item->id }}')" class="mx-3">
                                    <i class="fas fa-user-edit text-info" ></i>
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
                    </div>
                  </div>
              </div>
          </div>
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
