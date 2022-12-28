@section('migaspan')
      <nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
				<li class="breadcrumb-item text-sm">
					<a class="text-white" href="javascript:;">
						<i class="ni ni-box-2"></i>
					</a>
				</li>
				<li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
						href="{{url("")}}">Inicio</a></li>
				<li class="breadcrumb-item text-sm text-white active" aria-current="page">Gestion</li>
			</ol>
			<h6 class="font-weight-bolder mb-0 text-white">Ingresos/Egresos Categoria</h6>
		</nav> 
@endsection


@section('empresacollapse')
nav-link
@endsection


@section('empresaarrow')
true
@endsection


@section('ingresosegresosnav')
"nav-link active"
@endsection


@section('empresashow')
"collapse show"
@endsection

@section('ingresosegresosli')
"nav-item active"
@endsection


<div>
    <div class="d-sm-flex justify-content-between">
        <div>
        
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline">
            </div>
            <button wire:click="modalnuevacategoria()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" 
            type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Nueva Categoria</span> 
            </a>
        </div>
      </div>
  
      <br>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Categoria Cartera Movimiento</h6>
                    </div>
                    
                    <div  style="padding-left: 12px; padding-right: 12px;">

                        <div class="col-12 col-sm-12 col-md-4">
                            @include('common.searchbox')
                         </div>
                         
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                              <table class="table align-items-center mb-0">
                                <thead>
                                  <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder">No</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder ps-2">Nombre Categoria</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">Detalles</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">Tipo</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">Estado</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">Fecha Creación</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
              
              
              
                                  @foreach ($data as $p)
                                  <tr >
                                      <td class="text-xs mb-0 ">
                                          {{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}
                                      </td>
                                      <td class="text-xs mb-0 ">
                                          {{ $p->nombre }}
                                      </td>
                                      <td class="text-xs mb-0 text-center">
                                          {{ $p->detalle }}
                                      </td>
                                      <td class="text-xs mb-0 text-center">
                                          {{ $p->tipo }}
                                      </td>
                                      <td class="text-xs mb-0 text-center">
                                          @if($p->status == "ACTIVO")
                                          <div class="badge badge-sm bg-gradient-success"">
                                              {{ $p->status }}
                                          </div>
                                          @else
                                          <div class="badge badge-sm bg-gradient-danger">
                                              {{ $p->status }}
                                          </div>
                                          @endif
                                      </td>
                                      <td class="text-xs mb-0 text-center">
                                          {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i') }}
                                      </td>
                                      <td class="align-middle text-center">
                                          <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                              @if($p->status == "ACTIVO")
      
      
                                              <a href="javascript:void(0)"  wire:click.prevent="modaleditar({{$p->id}})" title="Editar Categoria" class="mx-3">
                                                  <i class="fas fa-edit text-default" ></i>
                                                </a>                                          
      
                                              <a href="javascript:void(0)" onclick="ConfirmarAnular({{ $p->id }},'{{ $p->nombre }}')" title="Anular Categoria" type="button">
                                                  <i class="fas fa-trash text-default" ></i>
                                                </a>
                                              @else
                                              <button wire:click.prevent="reacctivar({{$p->id}})" type="button" title="Reactivar Categoria">
                                                  <i class="fab fa-phabricator"></i>
                                              </button>
                                              @endif
                                          </div>
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
        </div>
        {{ $data->links() }}
        @include('livewire.carteramovcategoria.modalnuevacategoria')

</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Mètodo JavaScript para llamar al modal para crear o actualizar categorias
        window.livewire.on('nuevacategoria-show', Msg => {
            $("#modalnuevacategoria").modal("show");
        });
        //Cierra la ventana Modal Buscar Cliente y muestra mensaje Toast cuando se selecciona un Cliente
        window.livewire.on('nuevacategoria-hide', msg => {
            $("#modalnuevacategoria").modal("hide");
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });


        //Mostrar Mensaje Toast de Éxito
        window.livewire.on('accion-ok', event => {
        swal(
            '¡Anulado!',
            'La Categoria: "'+ @this.mensaje_toast +'" fue anulado con éxito.',
            'success'
            )
        });


        window.livewire.on('accion-toast-ok', event => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });




    });





    // Código para lanzar la Alerta de Anulación de Servicio
    function ConfirmarAnular(id, nombrecategoria) {
        swal({
        title: '¿Anular la Categoria "' + nombrecategoria + '"?',
        text: "Nombre Categoria: " + nombrecategoria,
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Anular Categoria',
        padding: '2em'
        }).then(function(result) {
        if (result.value) {
            window.livewire.emit('anularcategoria', id)
            }
        })
    }
    


</script>


<!-- Scripts para el mensaje de confirmacion arriba a la derecha 'Mensaje Toast' de Éxito y Alerta de Eliminacion -->
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
<!-- Fin Scripts -->
@endsection
