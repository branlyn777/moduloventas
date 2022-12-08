

<div>
    <div class="d-sm-flex justify-content-between">

      </div>

      <br>
      <br>
      <br>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Datos Empresa</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-xxs font-weight-bolder">Nombre de la Empresa</th>
                              <th class="text-uppercase text-xxs font-weight-bolder ps-2">Nombre Corto</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Dirección</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Teléfono</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Número Nit</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Logo</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
        
        
        
                            @foreach ($data as $item)
                            <tr>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $item->name }}
                                </p>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">
                                    {{ $item->shortname }}
                                </p>
                              </td>
                              <td class="align-middle text-center text-sm">

                                {{ $item->adress }}

                              </td>
                              <td class="align-middle text-center">
                                {{ $item->phone }}
                              </td>
                              <td class="align-middle text-center">
                                {{ $item->nit_id }}
                              </td>
                              <td class="align-middle text-center">
                                <span>
                                    <img src="{{ asset('storage/iconos/' . $item->image) }}" alt="imagen" width="70px" height="70px">
                                </span>
                              </td>
                              <td class="align-middle text-center">
                                <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                    class="boton-celeste" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>

                    {{ $data->links() }}


                </div>
            </div>
            @include('livewire.company.form')
        </div>
</div><script>
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
