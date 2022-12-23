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
			<h6 class="font-weight-bolder mb-0 text-white">Cajas</h6>
		</nav> 
@endsection


@section('empresacollapse')
nav-link
@endsection


@section('empresaarrow')
true
@endsection


@section('cajasnav')
"nav-link active"
@endsection


@section('empresashow')
"collapse show"
@endsection

@section('cajasli')
"nav-item active"
@endsection

<div>
    <div class="d-sm-flex justify-content-between">
        <div></div>
        <div class="nav-wrapper position-relative-right end-0">
            <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv"
                type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Nueva Caja</span>
            </button>

            <a href="carteras" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Ir a Cartera</span>
            </a>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Cajas | Listado</h6>
                </div>

                <div style="padding-left: 12px; padding-right: 12px;">

                    <div class="col-12 col-sm-12 col-md-4">
                        @include('common.searchbox')
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder">NOMBRE</th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder">ESTADO</th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder">SUCURSAL</th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td class="text-xs mb-0 ">
                                                {{ $item->nombre }}
                                            </td>
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->estado }}
                                            </td>
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->sucursal }}
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                                    class="mx-3" title="Edit">
                                                    <i class="fas fa-edit text-default" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $item->id }}','{{ $item->nombre }}','{{ $item->carteras->count() }}')"
                                                    class="mx-3" title="Delete">
                                                    <i class="fas fa-trash text-default" aria-hidden="true"></i>
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
        </div>
    </div>
    <div class="table-5">

        {{ $data->links() }}
    </div>
    @include('livewire.cajas.form')
</div>

<script>
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

    function Confirm(id, name, carteras) {
        if (carteras > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la caja "' + name + '" porque tiene ' +
                    carteras + ' carteras.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la caja ' + '"' + name + '"?.',
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
