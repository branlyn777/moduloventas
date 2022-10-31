@section('css')
<style>

.project-list-table {
    border-collapse: separate;
    border-spacing: 0 12px
}

.project-list-table tr {
    background-color: rgba(27, 154, 228, 0.19)
}

.table-nowrap td, .table-nowrap th {
    white-space: nowrap;
}
.table-borderless>:not(caption)>*>* {
    border-bottom-width: 0;
}
.table>:not(caption)>*>* {
    padding: 0.75rem 0.75rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}

.avatar-sm {
    height: 3rem;
    width: 3rem;
    /* border-width: 0.5rem;
    border-color: #3b76e1; */
}
.rounded-circle {
    border-radius: 50%!important;
    border: 3px solid rgb(117, 113, 113);
}
.me-2 {
    margin-right: 0.5rem!important;
}
img, svg {
    vertical-align: middle;
}

a {
    color: #3b76e1;
    text-decoration: none;
}

.badge-soft-danger {
    color: #fefefe !important;
    background-color: rgb(230, 81, 81);
}
.badge-soft-success {
    color: #ffffff !important;
    background-color: rgba(99, 173, 111, 0.967);
}

.badge-soft-primary {
    color: #3b76e1 !important;
    background-color: rgba(59,118,225,.1);
}

.badge-soft-info {
    color: #57c9eb !important;
    background-color: rgba(87,201,235,.1);
}

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
.bg-soft-primary {
    background-color: rgb(30, 52, 95)!important;
}
</style>
@endsection

<div>


    <div class="row">
        <div class="col-12 text-center mb-5">
          <p class="h2"><b>PROVEEDORES</b></p>
        </div>
    </div>
    <div class="row">

        <div class="col-12 col-sm-12 col-md-3">
            @include('common.searchbox')
        </div>

        <div class="col-12 col-sm-12 col-md-3 text-center">
            <select wire:model='estados' class="form-control">
                <option value="null" disabled>Estado</option>
                <option value="ACTIVO">ACTIVO</option>
                <option value="INACTIVO">INACTIVO</option>
                <option value="TODOS">TODOS</option>
              </select>
        </div>

        <div class="col-12 col-sm-12 col-md-3 text-center">
            
        </div>

        <div class="col-12 col-sm-12 col-md-3 text-center">
            <b style="color: white;">|</b>
            <button class="boton-azul-g" data-toggle="modal" data-target="#theModal" wire:click="resetUI()"> <i class="fas fa-plus-circle"></i> Agregar Proveedor</button>
        </div>

    </div>
 
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
        
        </div>
        <div class="col-md-6">
          
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap align-middle table-borderless">
                        <thead>
                            <tr>
                             
                                <th scope="col">Nombre</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">NIT</th>
                                <th scope="col">Estado</th>
                              
                                <th scope="col" style="width: 200px;">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_proveedor as $data)
                                
                            <tr>
                               
                                <td><img src="{{ asset('storage/proveedores/' . $data->imagen) }}" alt="" class="avatar-sm rounded-circle me-2" /><a href="#" class="text-body">{{$data->nombre_prov.' '.$data->apellido}}</a></td>
                                <td>{{$data->telefono ? $data->telefono : "No definido" }}</td>
                                <td>{{$data->correo ? $data->correo : "No definido" }}</td>
                                <td>{{$data->direccion ? $data->direccion : "No definido" }}</td>
                                <td>{{$data->nit ? $data->nit : "No definido" }}</td>
                                @if ($data->status== 'ACTIVO')
                                    
                                <td><span class="badge badge-soft-success mb-0">{{$data->status}}</span></td>
                                @else
                                <td><span class="badge badge-soft-danger mb-0">{{$data->status}}</span></td>
                                    
                                @endif
                                <td>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void(0);" wire:click="Edit({{ $data->id }})"  title="Editar proveedor" class="px-2 text-primary"><i class="fas fa-edit"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void(0);" onclick="Confirm('{{ $data->id }}','{{ $data->nombre }}',{{$data->compras->count()}})" title="Eliminar proveedor" class="px-2 text-danger"><i class="fas fa-trash"></i></a>
                                        </li>
                                        {{-- <li class="list-inline-item dropdown">
                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"><i class="bx bx-dots-vertical-rounded"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Accion</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </li> --}}
                                    </ul>
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

        @include('livewire.i_suplier.form')
    </div>
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
        });
        window.livewire.on('proveedor-deleted', msg => {
            ///
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