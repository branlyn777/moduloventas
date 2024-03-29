@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Gestion</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Usuarios</h6>
    </nav>
@endsection


@section('userscollapse')
    nav-link
@endsection


@section('userarrow')
    true
@endsection


@section('usernav')
    "nav-link active"
@endsection


@section('usershow')
    "collapse show"
@endsection

@section('userli')
    "nav-item active"
@endsection






<div>
    <div class="row">
        <div class="col-12">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Lista de Usuarios</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">

                            <button wire:click="Agregar()" class="btn btn-add mb-0"> <i class="fas fa-plus me-2"></i>
                                Nuevo Usuario</button>
                        </div>
                    </div>
                </div>
            <br>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">
                            <h6>Buscar</h6>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="nombre o numero de telefono" class="form-control ">
                                </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row justify-content-end">
                                <div class="col-md-5">

                                    <h6>Filtrar por Estado</h6>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" wire:model='estados' wire:change="cambioestado()" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        @if ($estados == true)
                                        <label style="font-size: 16px;
                                        font-weight: 400;
                                        line-height: 1.7;
                                        margin:0px 0.9rem;
                                        align-self: left;
                                        color: #525f7f;">Activos</label>
                                        @else
                                        <label style="font-size: 16px;
                                        font-weight: 400;
                                        line-height: 1.7;
                                        margin:0px 0.9rem;
                                        align-self: left;
                                        color: #525f7f;" >Inactivos</label>
                                        @endif
                                    </div>
                                    {{-- <select wire:model='estados' wire:change="cambioestado()" class="form-select">

                                        <option value="ACTIVE">Activo</option>
                                        <option value="LOCKED">Inactivo</option>

                                    </select> --}}

                                </div>
                                <div class="col-md-4">


                                    <h6>Filtrar por Sucursal</h6>
                                    <select wire:model='sucursal'  class="form-select">
                                        @if ($lista_sucursales!=null)
                                        @foreach ($sucursales as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                        <option value="Todos">Todas las Sucursales</option> 
                                        @else
                                        <option value=null>-- --</option> 
                                        @endif
                                      
                                    </select>

                                </div>
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <br>
            <div class="card mb-4">

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">Nº</th>
                                    <th class="text-uppercase text-sm">Usuario</th>
                                    <th class="text-uppercase text-sm ps-2">Teléfono</th>
                                    <th class="text-center text-uppercase text-sm  ps-2">Estado</th>
                                    <th class="text-center text-uppercase text-sm  ps-2">Sucursal</th>
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

                                                    <i class="fas fa-store text-warning"></i>
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

        // window.livewire.on('item-added', Msg => {
        //     $('#formUsers').modal('hide')
        // })
        window.livewire.on('item-added', Msg => {
            $('#formUsers').modal('hide');
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });

        // window.livewire.on('item-updated', Msg => {
        //     $('#formUsers').modal('hide')
        // })
        window.livewire.on('item-updated', Msg => {
            $('#formUsers').modal('hide')
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });

        window.livewire.on('sucursal-actualizada', Msg => {
            $('#modal-details').modal('hide')

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
            $("#im").val('')
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
                confirmButtonText: 'Aceptar',
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
