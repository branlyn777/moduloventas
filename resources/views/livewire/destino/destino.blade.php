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
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Parametros</li>
			</ol>
			<h6 class="font-weight-bolder mb-0 text-white">Destinos </h6>
		</nav> 
@endsection


@section('Gestionproductoscollapse')
nav-link
@endsection


@section('Gestionproductosarrow')
true
@endsection


@section('destinonav')
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

@section('destinoli')
"nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0" style="font-size: 16px">Destinos Productos</h5>
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a class="btn bg-gradient-primary btn-sm mb-0" wire:click="modalestancia()" style="font-size: 13px">Nuevo Destino</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-lg-flex">
                        <div class="col-12 col-sm-6 col-md-3 text-center">
                            @include('common.searchbox')
                        </div>

                        <div class="btn-group ms-auto my-auto">
                            <div class="p-2">
                                <select wire:model='sucursal_id' class="form-control">
                                    @foreach($sucursales as $s)
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                    @endforeach
                                    <option value="Todos">Todas las Sucursales</option>
                                </select>
                            </div>
                            <div class="p-2">
                                <select wire:model='estados' class="form-control">
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                    <option value="TODOS">TODOS</option>
                                </select>
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
                                            <th>#</th>
                                            <th style="text-align: left">NOMBRE</th>
                                            <th>OBSERVACION</th>
                                            <th>SUCURSAL</th>
                                            <th>FECHA CREACION</th>
                                            <th>FECHA ACTUALIZACION</th>
                                            <th>ESTADO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($destinos as $d)
                                            @if($d->venta == "No")
                                                <tr class="text-center" style="font-size: 12px">
                                                    <td>
                                                        {{ ($destinos->currentpage()-1) * $destinos->perpage() + $loop->index + 1 }}
                                                    </td>
                                                    <td style="text-align: left">
                                                        {{ $d->nombredestino }}
                                                    </td>
                                                    <td>
                                                        {{ $d->observacion }}
                                                    </td>
                                                    <td>
                                                        {{ $d->nombresucursal }}
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($d->creacion)->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($d->actualizacion)->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td>
                                                        @if ($d->estado == 'ACTIVO')
                                                            <span class="badge badge-sm bg-gradient-success">{{$d->estado}}</span>
                                                        @else
                                                            <span class="badge badge-sm bg-gradient-danger">{{$d->estado}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" wire:click="Edit({{ $d->iddestino }})" class="mx-3"
                                                            class="boton-azul" title="Editar Estancia">
                                                            <i class="fas fa-edit" style="font-size: 14px"></i>
                                                        </a>

                                                        {{-- <button onclick="Confirm('{{ $d->iddestino }}','{{ $d->nombre }}')" class="boton-rojo" title="Anular Estancia">
                                                            <i class="fas fa-trash"></i>
                                                        </button> --}}
                                                        <a href="javascript:void(0)" onclick="Confirm('{{ $d->iddestino }}','{{ $d->nombre }}')"
                                                            class="boton-rojo mx-3" title="Anular Estancia">
                                                            <i class="fas fa-trash text-danger"  style="font-size: 14px"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="text-center" style="background-color: rgb(248, 248, 178); font-size: 12px;">
                                                    <td>
                                                        {{ ($destinos->currentpage()-1) * $destinos->perpage() + $loop->index + 1 }}
                                                    </td>
                                                    
                                                    <td style="text-align: left; font-size: 12px">
                                                       {{ $d->nombredestino }}
                                                    </td>

                                                    <td>
                                                        {{ $d->observacion }}
                                                    </td>
                                                    <td>
                                                        {{ $d->nombresucursal }}
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($d->creacion)->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($d->actualizacion)->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td>
                                                        @if ($d->estado == 'ACTIVO')
                                                            <span class="badge badge-sm bg-gradient-success">{{$d->estado}}</span>
                                                        @else
                                                            <span class="badge badge-sm bg-gradient-danger">{{$d->estado}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" wire:click="Edit({{ $d->iddestino }})" class="mx-3"
                                                            class="boton-azul" title="Editar Estancia">
                                                            <i class="fas fa-edit" style="font-size: 14px"></i>
                                                        </a>
                                                        {{-- <button wire:click="Edit({{ $d->iddestino }})" class="boton-celeste" title="Editar Estancia">
                                                            <i class="fas fa-edit"></i>
                                                        </button> --}}
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $destinos->links() }}
            </div>
        </div>
    </div>
    @include('livewire.destino.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('unidad-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('unidad-updated', msg => {
            $('#theModal').modal('hide')
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
            text: 'Confirmar eliminar Destino ' + '"' + nombre + '"',
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