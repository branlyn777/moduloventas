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
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0" style="font-size: 16px">Marcas</h5>
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="javascript:void(0)" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal"
                                data-bs-target="#theModal">Agregar Marca</a>
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
                                        <tr class="text-center" style="font-size: 10.4px">
                                            <th>ITEM</th>                                
                                            <th>NOMBRE</th>                                
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($marcas as $data)
                                            <tr class="text-center"  style="font-size: 12px">
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
