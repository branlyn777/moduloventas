

<div>
      <div class="d-sm-flex justify-content-between">
        <div>
          
        </div>
        <div class="nav-wrapper position-relative end-0">
            <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" 
            type="button">
            <span class="btn-inner--icon">
                <i class="ni ni-fat-add"></i>
            </span class="btn-inner--text"> Nuevo Cliente</button>
        </div>
     </div>

     <br>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Listado | Cliente</h6>
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
                                <th class=" text-uppercase text-xxs font-weight-bolder">NOMBRE</th>
                                <th class="text-uppercase text-xxs font-weight-bolder ps-2">CÉDULA</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder">CELULAR</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder">EMAIL</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder">FECHA NACIM</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder">NIT</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder">DIRECCIÓN</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder">RAZÓN SOCIAL</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder">PROCEDENCIA</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder">ACCIONES</th>
                              </tr>
                            </thead>
                            <tbody>
          
                              @foreach ($data as $c)
                              <tr>
                                <td  class="text-xs mb-0 ">
                                  {{ $c->nombre }}
                                </td>
                                <td  class="text-xs mb-0 ">
                                  {{ $c->cedula }}
                                </td>
                                <td  class="text-xs mb-0 text-center">
                                  {{ $c->celular }}
                                </td>
                                <td  class="text-xs mb-0 text-center">
                                  {{ $c->email }}
                                </td>
                                <td  class="text-xs mb-0 text-center">
                                  {{$c->fecha_nacim }}
                                </td>
                                <td  class="text-xs mb-0 text-center">
                                  {{ $c->nit }}
                                </td>
                                <td  class="text-xs mb-0 text-center">
                                  {{ $c->direccion }}
                                </td>
                                <td  class="text-xs mb-0 text-center">
                                  {{ $c->razon_social }}
                                </td>
                                <td  class="text-xs mb-0 text-center">
                                  {{ $c->procedencia }}
                                </td>
  
                                <td class="align-middle text-center">
                                    <a href="javascript:void(0)" wire:click="Edit({{ $c->id }})" class="mx-3">
                                      <i class="fas fa-user-edit text-info" ></i>
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
        @include('livewire.cliente.form')
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
    });

    function Confirm(id, name) {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el usuario ' + '"' + name + '"',
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
