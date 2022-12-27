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


@section('migaspan')
      <nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
				<li class="breadcrumb-item text-sm">
					<a class="text-white" href="javascript:;">
						<i class="ni ni-box-2"></i>
					</a>
				</li>
				<li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
						href="{{url("")}}">Inicio</a></li>
				<li class="breadcrumb-item text-sm text-white active" aria-current="page">Inventarios</li>
			</ol>
			<h6 class="font-weight-bolder mb-0 text-white"> Proveedores </h6>
		</nav> 
@endsection


@section('Comprascollapse')
nav-link
@endsection


@section('Comprasarrow')
true
@endsection


@section('proveedoresnav')
"nav-link active"
@endsection


@section('Comprasshow')
"collapse show"
@endsection

@section('proveedoresli')
"nav-item active"
@endsection




<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0 text-white" style="font-size: 16h5x"><b>Proveedores</b></h5>
                    </div>

                    {{-- <button class="boton-azul-g" data-toggle="modal" data-target="#theModal" wire:click="resetUI()"> 
                        <i class="fas fa-plus-circle"></i> Agregar Proveedor</button> --}}
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="javascript:void(0)" class="btn btn-add btn-sm mb-0" data-bs-toggle="modal" 
                                data-bs-target="#theModal" wire:click="resetUI()">
                                <i class="fas fa-plus me-2"></i> Agregar Proveedor
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-lg-flex m-3">
                        <div class="col-12 col-sm-12 col-md-3 mt-3 pt-3">
                            {{-- @include('common.searchbox') --}}
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
                                </div>
                            </div>
                        </div>
                    
                        {{-- <div class="col-12 col-sm-12 col-md-3 text-center"> </div>--}}
                        <div class="ms-auto my-auto mt-lg-0 mt-4 col-md-2">
                            <div class="ms-auto my-auto">
                                <label>Estado</label>
                                <select wire:model='estados' class="form-select">
                                    <option value="null" disabled>Estado</option>
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                    <option value="TODOS">TODOS</option>
                                  </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br>
            <div class="card">
                
                
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
                                                        <span class="badge badge-sm bg-gradient-success">{{$data->status}}</span>
                                                        {{-- <span class="badge badge-success mb-0">{{$data->status}}</span> --}}
                                                    </td>
                                                @else
                                                    <td class="text-center" >
                                                        <span class="badge badge-sm bg-gradient-danger">{{$data->status}}</span>
                                                        {{-- <td class="text-center" ><span class="badge badge-danger mb-0">{{$data->status}}</span></td> --}}
                                                    </td>
                                                @endif
                                            <td>
                                                <div>
                                                    <a href="javascript:void(0)" wire:click="Edit({{ $data->id }})"
                                                        class="mx-3" title="Editar proveedor">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="Confirm('{{ $data->id }}','{{ $data->nombre }}',{{$data->compras->count()}})" 
                                                        class="mx-3" title="Eliminar proveedor">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
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