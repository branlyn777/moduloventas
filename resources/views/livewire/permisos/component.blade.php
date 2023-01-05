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
        <h6 class="font-weight-bolder mb-0 text-white">Permisos</h6>
    </nav>
@endsection


@section('userscollapse')
    nav-link
@endsection


@section('userarrow')
    true
@endsection


@section('permisosnav')
    "nav-link active"
@endsection


@section('usershow')
    "collapse show"
@endsection

@section('permisosli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12 ">
            <div class="d-lg-flex" style="margin-bottom: 2.3rem">
                <h5 class="text-white" style="font-size: 16px">Lista Permisos </h5>

            </div>


            <div class="card mb-4">
                <div class="card-body">
                    <div class="col-12 col-sm-12 col-md-3">
                        <h6>Buscar</h6>
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                            <input type="text" wire:model="search" placeholder="nombre o área de permiso"
                                class="form-control ">
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">Nº</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">NOMBRE</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">ÁREA</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">DESCRIPCIÓN</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $permiso)
                                    <tr class="text-left">
                                        <td class="text-sm mb-0 text-center">
                                            {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $permiso->name }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $permiso->area }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $permiso->descripcion == null ? 'S/N' : substr($permiso->descripcion, 0, 35) }}
                                        </td>

                                        <td class="text-sm ps-0 text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $permiso->id }})"
                                                class="text-center" title="Editar registro">
                                                <i class="fas fa-edit text-info" aria-hidden="true"></i>
                                            </a>
                                            {{-- <a href="javascript:void(0)" onclick="Confirm('{{ $permiso->id }}','{{ $permiso->name }}')" 
                                                    class="boton-rojo" title="Eliminar registro">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a> --}}
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

    <div class="table-5">

        {{ $data->links() }}
    </div>
    @include('livewire.permisos.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-update', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('item-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-exists', Msg => {
            noty(Msg)
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('modal-hide', Msg => {
            $('#theModal').modal('hide')
        })




        //Cerrar Ventana Modal Cambiar Usuario Vendedor y Mostrar Toast Cambio Exitosamente
        window.livewire.on('message-toast', msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'info',
                title: "El permiso no se puede eliminar porque tiene roles asignados a este",
                padding: '2em',
            })
        });






    });

    function Confirm(id, name) {

        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el permiso ' + '"' + name + '"',
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
