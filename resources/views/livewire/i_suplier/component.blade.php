@section('css')
<style>

.avatar-title {
    align-items: center;
    background-color: #3b76e1;
    color: #fff;
    display: flex;
    font-weight: 500;
    height: 100%;
    justify-content: center;
    width: 100%;
}
</style>
@endsection

<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0" style="font-size: 16h5x"><b>Proveedores</b></h5>
                        </div>

                        {{-- <button class="boton-azul-g" data-toggle="modal" data-target="#theModal" wire:click="resetUI()"> 
                            <i class="fas fa-plus-circle"></i> Agregar Proveedor</button> --}}
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="javascript:void(0)" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" 
                                    data-bs-target="#theModal" wire:click="resetUI()">
                                    <i class="fas fa-plus-circle"></i> Agregar Proveedor
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-lg-flex">
                        <div class="col-12 col-sm-12 col-md-3">
                            @include('common.searchbox')
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                {{-- <div class="col-12 col-sm-12 col-md-3 text-center"> --}}
                                    <select wire:model='estados' class="form-control">
                                        <option value="null" disabled>Estado</option>
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                        <option value="TODOS">TODOS</option>
                                      </select>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="text-center" style="font-size: 10.4px">
                                            <th>NOMBRE</th>
                                            <th>TELEFONO</th>
                                            <th>CORREO</th>
                                            <th>DIRECCION</th>
                                            <th>NIT</th>
                                            <th>ESTADO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_proveedor as $data)
                                            
                                        <tr class="text-center" style="font-size: 12px">
                                        
                                            <td><img src="{{ asset('storage/proveedores/' . $data->imagen) }}" 
                                                alt="proveedor" class="avatar-sm rounded-circle me-2 m-1" />{{$data->nombre_prov.' '.$data->apellido}}</td>
                                            <td>{{$data->telefono ? $data->telefono : "No definido" }}</td>
                                            <td>{{$data->correo ? $data->correo : "No definido" }}</td>
                                            <td>{{$data->direccion ? $data->direccion : "No definido" }}</td>
                                            <td>{{$data->nit ? $data->nit : "No definido" }}</td>
                                            @if ($data->status== 'ACTIVO')
                                                
                                            <td class="text-center" >
                                                <span class="badge badge-success mb-0">{{$data->status}}</span>
                                            </td>
                                            @else
                                            <td class="text-center" ><span class="badge badge-danger mb-0">{{$data->status}}</span></td>
                                                
                                            @endif
                                            <td>
                                                <div>
                                                    <button  wire:click="Edit({{ $data->id }})"  title="Editar proveedor" class="boton-azul mr-1">
                                                        <i class="fas fa-edit"></i></button>
                                                    <button  onclick="Confirm('{{ $data->id }}','{{ $data->nombre }}',{{$data->compras->count()}})" 
                                                        title="Eliminar proveedor" class="boton-rojo"><i class="fas fa-trash"></i></button>
                                                </div>
                                            
                                            </td>
                                        </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table><br>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $data_proveedor->links() }}
            </div>
        </div>
    </div>
    @include('livewire.i_suplier.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      
        window.livewire.on('proveedor-added', msg => {
            $('#theModal').modal('hide');
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
        window.livewire.on('proveedor-updated', msg => {
            $('#theModal').modal('hide')
            $("#im").val('');
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
        window.livewire.on('proveedor-deleted', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });        
        $('theModal').on('hidden.bs.modal',function(e) {
            $('.er').css('display','none')
        })

    });

    function Confirm(id,nombre,compras) {
     

        if(compras != 0){
            swal.fire({
                title: 'Error',
                icon: 'warning',
                text: 'El proveedor' + nombre + ' tiene relacion con otros registros del sistema, no puede ser eliminado',
              
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#383838',
           
         
            })
        }
        else{

            swal.fire({
                title: 'CONFIRMAR',
                icon: 'warning',
                text: 'Confirmar eliminar la proveedor ' + '"' + nombre + '"',
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

    }
</script>