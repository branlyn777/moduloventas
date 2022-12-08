

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
        <span class="btn-inner--text">Nuevo Cliente</span> 
        </button>
        </div>
      </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Listado Cliente</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-xxs font-weight-bolder">NOMBRE</th>
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
                              <td>
                                <div class="d-flex px-2 py-1">
                                    <p class="text-xs font-weight-bold mb-0">{{ $c->nombre }}</p>
                                </div>
                              </td>

                              <td>
                                <div class="d-flex px-2 py-1">
                                    <p class="text-xs font-weight-bold mb-0">{{ $c->cedula }}</p>
                                </div>
                              </td>

                              <td>
                                <div class="d-flex px-2 py-1">
                                    <p class="text-xs font-weight-bold mb-0">{{ $c->celular }}</p>
                                </div>
                              </td>

                              <td>
                                <div class="d-flex px-2 py-1">
                                    <p class="text-xs font-weight-bold mb-0">{{ $c->email }}</p>
                                </div>
                              </td>

                              <td>
                                <div class="d-flex px-2 py-1">
                                    <p class="text-xs font-weight-bold mb-0">{{$c->fecha_nacim }}</p>
                                </div>
                              </td>

                              <td>
                                <div class="d-flex px-2 py-1">
                                    <p class="text-xs font-weight-bold mb-0">{{ $c->nit }}</p>
                                </div>
                              </td>

                              <td>
                                <div class="d-flex px-2 py-1">
                                    <p class="text-xs font-weight-bold mb-0">{{ $c->direccion }}</p>
                                </div>
                              </td>

                              <td>
                                <div class="d-flex px-2 py-1">
                                    <p class="text-xs font-weight-bold mb-0">{{ $c->nombre }}</p>
                                </div>
                              </td>

                              <td class="align-middle text-center">
                                  <a href="javascript:void(0)" wire:click.prevent="viewDetails('{{ $r->id }}')" class="mx-3">
                                    <i class="fas fa-eye text-default"></i>
                                  </a>
                                  <a href="javascript:void(0)" wire:click="Edit({{ $r->id }})" class="mx-3">
                                    <i class="fas fa-user-edit text-info" ></i>
                                  </a>
                                  <a href="javascript:void(0)" onclick="Confirm('{{ $r->id }}','{{ $r->name }}')" class="mx-3">
                                    <i class="fas fa-trash text-danger" ></i>
                                  </a>
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

        @include('livewire.users.form')
        @include('livewire.users.modalDetails')
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
        window.livewire.on('sucursal-actualizada', Msg => {
            $('#modal-details').modal('hide')
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
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        });
        window.livewire.on('user-withsales', Msg => {
            noty(Msg)
        })
        window.livewire.on('user-fin', Msg => {
            $('#modal-details').modal('hide')
            noty(Msg)
        })
        window.livewire.on('show-modal2', Msg => {
            $('#modal-details').modal('show')
        })
    });

    function Confirm(id, name, movimientos) {
        if (movimientos > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar al usuario "' + name + '" porque tiene varios movimientos.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar el usuario ?',
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
