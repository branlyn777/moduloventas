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
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Marcas</li>
			</ol>
			<h6 class="font-weight-bolder mb-0 text-white">Marcas</h6>
		</nav> 
@endsection


@section('Gestionproductoscollapse')
nav-link
@endsection


@section('Gestionproductosarrow')
true
@endsection


@section('marcasnav')
"nav-link active"
@endsection


@section('Gestionproductosshow')
"collapse show"
@endsection

@section('parametrocollapse')
nav-link
@endsection


@section('parametroarrow')
true
@endsection

@section('parametroshow')
"collapse show"
@endsection

@section('marcasli')
"nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">
           
                <div class="d-lg-flex my-auto p-0 mb-3">
                    <div>
                        <h5 class=" text-white" style="font-size: 16px">Marcas</h5>
                    </div>

                    <div class="ms-auto my-auto mt-lg-1">
                        <div class="ms-auto my-auto">
                            <a class="btn btn-add mb-0" data-bs-toggle="modal" data-bs-target="#theModal"><i class="fas fa-plus"></i> Agregar Marca</a>
                        </div>
                    </div>

                        
                </div>
            
            <div class="card mb-4">
                <div class="card-body  p-4">

                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">
                            <h6>Buscar</h6>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="nombre de marca" class="form-control ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-uppercase text-sm text-center">N°</th>                                
                                            <th class="text-uppercase text-sm text-center">NOMBRE</th>                                
                                            <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($marcas as $data)
                                            <tr class="text-center"  style="font-size: 14px">
                                                <td>
                                                    {{ $loop->index+1 }}
                                                </td>
                                                <td>
                                                    {{ $data->nombre }}
                                                </td>
                                                
                                                <td>
                                                    <a href="javascript:void(0)" wire:click="Edit({{ $data->id }})"
                                                        class="mx-3" title="Editar marca">
                                                        <i class="fas fa-edit text-info"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="Confirm('{{ $data->id }}','{{ $data->nombre }}')" 
                                                        class="mx-3" title="Eliminar marca">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $marcas->links()}}
            </div>
        </div>
    </div>
    @include('livewire.marca.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('marca-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('marca-updated', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('marca-deleted', msg => {
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

    function Confirm(id,nombre) {
     
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar la marca ' + '"' + nombre + '"',
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
