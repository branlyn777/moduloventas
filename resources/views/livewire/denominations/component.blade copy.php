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
			<h6 class="font-weight-bolder mb-0 text-white">Moneda</h6>
		</nav> 
@endsection


@section('empresacollapse')
nav-link
@endsection


@section('empresaarrow')
true
@endsection


@section('monedanav')
"nav-link active"
@endsection


@section('empresashow')
"collapse show"
@endsection

@section('monedali')
"nav-item active"
@endsection

<div>
    <div class="d-sm-flex justify-content-between">
        <div>

        </div>
        <div class="d-flex">
            <div class="dropdown d-inline">
            </div>
            <button wire:click="$emit('modal-show')" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv"
                type="button">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text">Agregar</span>
                </a>
            </button>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Monedas | Listado</h6>
                </div>
                <div style="padding-left: 12px; padding-right: 12px;">

                    <div class="col-12 col-sm-12 col-md-4">
                        @include('common.searchbox')
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-left mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xxs font-weight-bolder">TIPO</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder ps-2 text-left">VALOR</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder ps-2 text-left">IMAGEN
                                        </th>
                                        <th class="text-uppercase text-xxs font-weight-bolder ps-2 text-left">ACCIONES
                                        </th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($data as $coin)
                                        <tr>
                                            <td>
                                                <p class="text-xs mb-0">{{ $coin->type }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs mb-0">{{ number_format($coin->value, 2) }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('storage/monedas/' . $coin->imagen) }}"
                                                            alt="imagen de ejemplo" height="70" class="rounded">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-left">
                                                <a href="javascript:void(0)"
                                                    wire:click.prevent="Edit('{{ $coin->id }}')" class="mx-3">
                                                    <i class="fas fa-edit text-default"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $coin->id }}','{{ $coin->type }}')"
                                                    class="mx-3">
                                                    <i class="fas fa-trash text-default"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.denominations.form')
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('coin-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('coin-updated', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('coin-deleted', msg => {
            ///
        });
        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
        $('theModal').on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none')
        })

    });

    function Confirm(id, type, products) {
        if (products > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la moneda, ' + type + ' porque tiene ' +
                    products + ' ventas relacionadas'
            })
            return;
        }
       

        swal({
            title: 'CONFIRMAR',
            text: 'Confirmar eliminar la moneda del tipo "' + type + '"',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Eliminar',
            padding: '2em'
                }).then(function(result) {
                    if (result.value) {
                        window.livewire.emit('deleteRow', id)
                    }
                })
    }
</script>
