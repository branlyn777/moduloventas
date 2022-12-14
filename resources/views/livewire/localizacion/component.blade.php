<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5  class="mb-0">Mobiliarios</h5>
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                            <a href="javascript:void(0)" class="btn bg-gradient-primary btn-sm mb-0" wire:click='resetUI()' data-bs-toggle="modal" wire:click="$set('selected_id', 0)"
                                data-bs-target="#theModal">Agregar</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-lg-flex">
                        <div class="col-12 col-sm-12 col-md-3">
                            @include('common.searchbox')
                        </div>
                    </div>
                </div>
                
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>TIPO</th>
                                            <th>CODIGO</th>
                                            <th>DESCRIPCION</th>
                                            <th>UBICACION</th>
                                            <th>PRODUCTOS</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_locations as $location)
                                        <tr>
                                            <td>
                                                <h6>{{ ($data_locations->currentpage()-1) * $data_locations->perpage() + $loop->index + 1 }}</h6>
                                            </td>
                                            <td>
                                                <h6>{{ $location->tipo }}</h6>
                                            </td>
                                            <td>
                                                <h6>{{ $location->codigo }}</h6>
                                            </td>
                                                <td>
                                                    <h6>{{ $location->descripcion }}</h6>
                                                </td>
                                                <td>
                                                    <h6>{{ $location->destino }}
                                                    <br>
                                                    {{ $location->sucursal}}</h6>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="javascript:void(0)" wire:click="ver({{$location->id}})"
                                                        class="btn btn-info m-1 text-dark p-1" title="Ver subcategorias"> <b class="pl-1">{{ $location->product->count()}}</b> 
                                                        <i class="fas fa-eye"></i>
                                                        </a>
                                                    </center>
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" wire:click="Edit({{ $location->id }})"
                                                        class="btn btn-dark p-1 m-0" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                       
                                                    <a href="javascript:void(0)" wire:click="asignaridmob({{$location->id}})" 
                                                        class="btn btn-warning p-1 m-0" title="Agregar Productos a este mobiliario">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        onclick="Confirm('{{ $location->id }}','{{ $location->descripcion }}')"
                                                        class="btn btn-danger p-1 m-0" title="Agregar Mobiliario">
                                                        <i class="fas fa-trash"></i>
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
                {{ $data_locations->links() }}
            </div>  
        </div>
    </div>
    @include('livewire.localizacion.form')
    @include('livewire.localizacion.verproductos')
    @include('livewire.localizacion.modal_asignar_mobiliario')
</div>



@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {


        window.livewire.on('localizacion-added', msg => {
            $('#theModal').modal('hide'),
            noty(msg)
        });
        window.livewire.on('localizacion-assigned', msg => {
            $('#asignar_mobiliario').modal('hide'),
            noty(msg)
        });
        window.livewire.on('location-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('localizacion-deleted', msg => {
            noty(msg)
        });
        window.livewire.on('modal-locacion', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('verprod', function(e) {
            $('#verproductos').modal('show')
        });
        window.livewire.on('show-modal', msg => {
             $('#asignar_mobiliario').modal('show')
         });
         
    });

    function Confirm(id, descripcion, locations) {
        if (locations > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar el producto, ' + descripcion + ' porque tiene ' +
                    locations + ' ventas relacionadas'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar la locacion ' + '"' + descripcion + '"',
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
@endsection