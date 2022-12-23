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
			<h6 class="font-weight-bolder mb-0 text-white">Usuarios</h6>
		</nav> 
@endsection

<div>
    <div class="d-sm-flex justify-content-between">
        <div>
            {{-- <a href="javascript:void(0)" class="btn btn-icon btn-outline-white">
        New order
        </a> --}}
        </div>
        <div class="d-flex">
            {{-- <div class="dropdown d-inline">
          <a href="javascript:void(0)" class="btn btn-outline-white dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2" aria-expanded="false">
          Filtrar
          </a>
          <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" style="">
            <li><a class="dropdown-item border-radius-md" href="javascript:void(0)">Estado: Activo</a></li>
            <li><a class="dropdown-item border-radius-md" href="javascript:void(0)">Estado: Inactivo</a></li>
            <li>
            <hr class="horizontal dark my-2">
            </li>
            <li><a class="dropdown-item border-radius-md text-danger" href="javascript:void(0)">Remover Filtros</a></li>
          </ul>
        </div> --}}
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Lista de Usuarios</h6>


                    <div class="d-lg-flex">
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">


                                <button wire:click="Agregar()" class="btn bg-gradient-primary btn-sm mb-0">
                                    <div class="text-sm">
                                        <i class="fas fa-plus me-2"></i>
                                        Nuevo Usuario
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>


                  


                </div>
                <div class="d-flex m-3">
                    <div class="col-12 col-sm-12 col-md-3 mt-3 pt-3">
                        @include('common.searchbox')
                    </div>

                    <div class="ms-auto my-auto mt-lg-0 mt-4 col-md-2">
                        <div class="ms-auto my-auto">
                            <label>Estado</label>
                            <div class="col-12 col-sm-12 text-center">
                                <select wire:model='estados' class="form-select">

                                    <option value="ACTIVE">ACTIVO</option>
                                    <option value="LOCKED">INACTIVO</option>
                                    <option value="TODOS">TODOS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">Nº</th>
                                    <th class="text-uppercase text-sm">Usuario</th>
                                    <th class="text-uppercase text-sm ps-2">Teléfono</th>
                                    <th class="text-center text-uppercase text-sm  ps-2">Estado</th>
                                    <th class="text-center text-uppercase text-sm ps-2">Sucursal</th>
                                    <th class="text-center text-uppercase text-sm  ps-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($data as $r)
                                    <tr>
                                        <td class="text-sm mb-0 text-center">
                                            {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('storage/usuarios/' . $r->imagen) }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $r->name }}</h6>
                                                    <p class="text-xs mb-0">{{ $r->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $r->phone }}</p>
                                            <p class="text-xs mb-0">{{ $r->profile }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">

                                            @if ($r->status == 'ACTIVE')
                                                <span class="badge badge-sm bg-gradient-success">
                                                    ACTIVO
                                                </span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">
                                                    INACTIVO
                                                </span>
                                            @endif

                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs text-xs font-weight-bold">
                                                @foreach ($r->sucursalusers as $su)
                                                    @if ($su->estado == 'ACTIVO')
                                                        {{ $su->sucursal->name }}
                                                    @endif
                                                @endforeach
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $r->id }})"
                                                class="mx-3">
                                                <i class="fas fa-user-edit text-info"></i>

                                            </a>
                                            @if ($r->status == 'ACTIVE')
                                                <a href="javascript:void(0)"
                                                    wire:click="viewDetails('{{ $r->id }}')" class="mx-3">

                                                    <i class="fas fa-store"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $r->id }}','{{ $r->name }}',{{ $r->ventas->count() }},{{ $r->compras->count() }},{{ $r->transferencia->count() }},{{ $r->ingreso->count() }})"
                                                    class="mx-3">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            @endif







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

    @include('livewire.users.form')
    @include('livewire.users.modalDetails')
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#formUsers').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-updated', Msg => {
            $('#formUsers').modal('hide')
            noty(Msg)
        })
        window.livewire.on('sucursal-actualizada', Msg => {
            $('#modal-details').modal('hide')
            noty(Msg)
        })
        window.livewire.on('atencion', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'info',
                title: "¡No puedes eliminarte a ti mismo!",
                padding: '2em',
            })
        })
        window.livewire.on('item-deleted', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: "¡Acción realizada con éxito!",
                padding: '2em',
            })
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#formUsers').modal('show')
        })

        window.livewire.on('hide-modal', Msg => {
            $('#formUsers').modal('hide')
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        });
        window.livewire.on('user-withsales', Msg => {
            noty(Msg)
        })
        window.livewire.on('user-fin', Msg => {
            $('#modal-details').modal('hide')
            noty(Msg)
        })
        window.livewire.on('show-modal2', Msg => {
            $('#modal-details').modal('show')
        })
    });

    function Confirm(id, name, venta, compra, transferencia, ingreso) {

        if (venta !== 0 || compra !== 0 || transferencia !== 0 || ingreso !== 0) {
            swal({
                title: '¿Inactivar al usuario "' + name + '"?',
                text: "El usuario " + name +
                    " no se puede eliminar, pasara a ser inactivado y bloqueado del sistema.",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Inactivar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRow', id)
                }
            })

        } else {
            swal({
                title: '¿Eliminar al usuario "' + name + '"?',
                text: "Eliminar al usuario " + name + " permanentemente del sistema.",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Eliminar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRowPermanently', id)
                }
            })


            //     const toast = swal.mixin({
            //     toast: true,    
            //     position: 'top-end',
            //     showConfirmButton: false,
            //     timer: 2500,
            //     padding: '2em'
            // });
            // toast({
            //     type: 'success',
            //     title: "Usuario eliminado exitosamente.",
            //     padding: '2em',
            // })

        }

    }
</script>
{{-- <script>

</script> --}}
