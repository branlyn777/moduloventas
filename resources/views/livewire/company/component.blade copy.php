

<div>
        <div class="row">
            <div class="col-12">

             



              <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Datos Empresa</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            
                        </div>
                    </div>
                </div>
            </div><br>




                <div class="card mb-4">
                    
                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>Nombre Corto</th>
                              <th>Dirección</th>
                              <th>Teléfono</th>
                              <th>Número Nit</th>
                              <th>Logo</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
        
        
        
                            @foreach ($data as $item)
                            <tr>
                              <td style="padding-left: 25px;">
                                
                                    {{ $item->name }}
                                
                              </td>
                              <td style="padding-left: 25px;">
                                {{ $item->shortname }}
                              </td>
                              <td style="padding-left: 25px;">

                                {{ $item->adress }}

                              </td>
                              <td style="padding-left: 25px;">
                                {{ $item->phone }}
                              </td>
                              <td style="padding-left: 25px;">
                                {{ $item->nit_id }}
                              </td>
                              <td style="padding-left: 25px;">
                                <span>
                                    <img src="{{ asset('storage/iconos/' . $item->image) }}" alt="imagen" width="70px" height="70px">
                                </span>
                              </td>
                              <td style="padding-left: 25px;">
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
