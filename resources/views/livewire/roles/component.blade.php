

<div>
    <div class="d-sm-flex justify-content-between">

        <div class="col-12 col-sm-12 col-md-4">
          @include('common.searchbox')
        </div>

        <div class="d-flex">
        <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" type="button">
        <span class="btn-inner--icon">
            <i class="ni ni-fat-add"></i>
        </span>
        <span class="btn-inner--text">Nuevo Rol</span> 
        </button>
        </div>
      </div>

      <br>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Roles Listado</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-xxs font-weight-bolder">Nº</th>
                              <th class="text-uppercase text-xxs font-weight-bolder ps-2">DESCRIPCION</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">FECHA CREACION</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">FECHA ACTUALIZACION</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">ACCIONES</th>
                            </tr>
                          </thead>
                          <tbody>
        
        
        
                            @foreach ($data as $rol)
                            <tr>
                              <td>
                                <p class="text-xs font-weight-bold mb-0 ">{{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}</p>
                              </td>

                              <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $rol->name }}</p>
                              </td>

                              <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0"> {{ \Carbon\Carbon::parse($rol->created_at)->format('d/m/Y H:i') }}</p>
                              </td>

                              <td class="align-middle text-center ">
                                <p class="text-xs font-weight-bold mb-0">  {{ \Carbon\Carbon::parse($rol->updated_at)->format('d/m/Y H:i') }}</p>
                              </td>

                              <td class="align-middle text-center">
                                  <a href="javascript:void(0)" wire:click.prevent="Edit('{{ $rol->id }}')" class="mx-3">
                                    <i class="fas fa-user-edit text-info" ></i>
                                  </a>
                                  <a href="javascript:void(0)" onclick="Confirm('{{ $rol->id }}','{{ $rol->name }}')" class="mx-3">
                                    <i class="fas fa-trash text-danger" ></i>
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
        @include('livewire.roles.form')
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
        window.livewire.on('role-deleted', Msg => {
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
  
  
    });
  
    function Confirm(id, name, usuarios) {
        if (usuarios > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar el role "' + name + '" porque hay ' +
                    usuarios + ' usuarios con ese role.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el role ' + '"' + name + '"',
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
