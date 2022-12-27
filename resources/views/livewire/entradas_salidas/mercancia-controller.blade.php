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
			<h6 class="font-weight-bolder mb-0 text-white">Entrada/Salida</h6>
		</nav> 
@endsection


@section('Gestionproductoscollapse')
nav-link
@endsection


@section('Gestionproductosarrow')
true
@endsection


@section('entradasalidanav')
"nav-link active"
@endsection


@section('Gestionproductosshow')
"collapse show"
@endsection

@section('entradasalidali')
"nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white">Entrada y Salida de Productos</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <button type="button" class="btn btn-add btn-sm mb-0" data-bs-toggle="modal"
                                wire:click='resetui()' data-bs-target="#operacion"><i class="fas fa-plus me-2"></i> Registrar Operacion</button>
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
                                    <input type="text" placeholder="Buscar" class="form-control">
                                </div>
                            </div>
                        </div>
                    
                        {{-- <div class="col-12 col-sm-12 col-md-3 text-center"> </div>--}}
                        <div class="ms-auto my-auto mt-lg-0 mt-4 col-md-2">
                            <div class="ms-auto my-auto">
                                <label>Estado</label>
                                <select wire:model="tipo_de_operacion" class="form-select">
                                    <option value="Entrada">Entrada</option>
                                    <option value="Salida">Salida</option>
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
                                        <tr>
                                            <th class="text-uppercase text-sm text-center">#</th>
                                            <th  class="text-uppercase text-sm text-center">Fecha de Registro</th>
                                            <th  class="text-uppercase text-sm text-center">Almacen</th>
                                            <th  class="text-uppercase text-sm text-center">Tipo Operacion</th>
                                            <th  class="text-uppercase text-sm text-center">Observacion</th>
                                            <th  class="text-uppercase text-sm text-center">Usuario</th>
                                            <th  class="text-uppercase text-sm text-center">Acc.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ingprod as $data2)
                                        <tr>
                                            <td class="text-center">

                                                <h6>{{ ($ingprod->currentpage()-1) * $ingprod->perpage() + $loop->index
                                                    + 1 }}</h6>

                                            </td>
                                            <td>
                                                <center>

                                                    {{\Carbon\Carbon::parse($data2->created_at)->format('d-m-Y')}}
                                                    <br>
                                                    {{\Carbon\Carbon::parse($data2->created_at)->format('h:i:s a')}}
                                                </center>
                                            </td>

                                            <td>
                                                Sucursal {{$data2->destinos->sucursals->name}}
                                                {{$data2->destinos->nombre}}

                                            </td>
                                            <td class="text-center">
                                                {{$data2->concepto}}
                                            </td>
                                            <td>
                                                {{$data2->observacion}}
                                            </td>
                                            <td>
                                                {{$data2->usuarios->name}}
                                            </td>
                                            <td class="text-center">
                                                <center>
                                                    <a wire:click="ver({{ $data2->id }})" type="button"
                                                        class="text-primary  mx-2">

                                                        <i class="fas fa-list"></i>
                                                    </a>
                                                    <a wire:click="verifySale({{ $data2->id }})" type="button"
                                                        class="text-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </center>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $ingprod->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('livewire.entradas_salidas.operacion')
    @include('livewire.entradas_salidas.buscarproducto')
</div>


@section('javascript')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('product-added', msg => {
            $('#operacion').modal('hide')
            
        });
        window.livewire.on('show-detail', msg => {
            $('#buscarproducto').modal('show')
            
        });

        window.livewire.on('venta', event => {
            swal(
                '¡No se puede eliminar el registro!',
                'Uno o varios de los productos de este registro ya fueron distribuidos y/o tiene relacion con varios registros del sistema.',
                'error'
                )
        });
  
        window.livewire.on('confirmar', event => {
         
            Swal.fire({
                title: 'Estas seguro de eliminar este registro?',
                text: "Esta accion es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
            if (result.value) {
            
                window.livewire.emit('eliminar_registro');
                Swal.fire(
                'Eliminado!',
                 'El registro fue eliminado con exito',
                'success'
                 )
             }
            })
				
            });
        window.livewire.on('confirmarAll', event => {
         
            Swal.fire({
                title: 'Estas seguro de eliminar este registro?',
                text: "Esta accion es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
            if (result.value) {
            
                window.livewire.emit('eliminar_registro_total');
                Swal.fire(
                'Eliminado!',
                 'El registro fue eliminado con exito',
                'success'
                 )
             }
            })
				
            });
            window.livewire.on('stock-insuficiente', event => {
        
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Stock insuficiente para la salida del producto en esta ubicacion.',
                padding: '2em',
            })
     });
  
    })
</script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection