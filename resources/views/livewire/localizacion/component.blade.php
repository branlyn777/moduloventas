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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Inventarios</li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Estanteria</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Estanterias</h6>
    </nav>
@endsection


@section('Gestionproductoscollapse')
    nav-link
@endsection


@section('Gestionproductosarrow')
    true
@endsection


@section('mobiliariosnav')
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

@section('mobiliariosli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Lista de Estanterias</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a href="javascript:void(0)" class="btn btn-add mb-0" wire:click='resetUI()'
                            data-bs-toggle="modal" wire:click="$set('selected_id', 0)" data-bs-target="#theModal"><i
                                class="fas fa-plus me-2"></i> Nueva Estanteria</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">
                            <h6>Buscar</h6>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="codigo, tipo"
                                        class="form-control">
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
                                    <th class="text-uppercase text-sm text-center">N°</th>
                                    <th class="text-uppercase text-sm ps-2">TIPO</th>
                                    <th class="text-uppercase text-sm ps-2">CÓDIGO</th>
                                    <th class="text-uppercase text-sm ps-2">DESCRIPCIÓN</th>
                                    <th class="text-uppercase text-sm ps-2">UBICACIÓN</th>
                                    <th class="text-uppercase text-sm ps-2">PRODUCTOS</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_locations as $location)
                                    <tr style="font-size: 14px">
                                        <td class="text-center">
                                            {{ ($data_locations->currentpage() - 1) * $data_locations->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td style="text-align: left">
                                            {{ $location->tipo }}
                                        </td>
                                        <td>
                                            {{ $location->codigo }}
                                        </td>
                                        <td>
                                            {{ $location->descripcion }}
                                        </td>
                                        <td>
                                            {{ $location->destino }}
                                            <br>
                                            {{ $location->sucursal }}
                                        </td>
                                        <td>
                                            {{-- <a href="javascript:void(0)" wire:click="ver({{$location->id}})"
                                                            class="btn btn-info m-1 text-dark p-1" title="Ver subcategorias"> 
                                                            <b class="pl-1">{{ $location->product->count()}}</b> 
                                                            <i class="fas fa-eye"></i>
                                                        </a> --}}

                                            <a href="javascript:void(0)" wire:click="ver({{ $location->id }})"
                                                class="mx-3" title="Ver subcategorias">
                                                <b class="mx-3">{{ $location->product->count() }}</b>
                                                <i class="fas fa-eye" style="font-size: 14px"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $location->id }})"
                                                class="mx-3" title="Editar">
                                                <i class="fas fa-edit text-info" style="font-size: 14px"></i>
                                            </a>

                                            <a href="javascript:void(0)" wire:click="asignaridmob({{ $location->id }})"
                                                class="mx-3" title="Agregar Productos a este mobiliario">
                                                <i class="fas fa-plus" style="font-size: 14px"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                onclick="Confirm('{{ $location->id }}','{{ $location->descripcion }}','{{ $location->product->count()}}')"
                                                class="mx-3" title="Agregar Mobiliario">
                                                <i class="fas fa-trash text-danger" style="font-size: 14px"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $data_locations->links() }}
        </div>
    </div>
    @include('livewire.localizacion.form')
    @include('livewire.localizacion.verproductos')
    @include('livewire.localizacion.modal_asignar_mobiliario')
</div>





@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('localizacion-added', Msg => {
                $('#theModal').modal('hide');
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
            window.livewire.on('localizacion-assigned', msg => {
                $('#asignar_mobiliario').modal('hide'),
                    noty(msg)
            });

            window.livewire.on('location-updated', Msg => {
                $('#theModal').modal('hide')
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

            window.livewire.on('localizacion-deleted', Msg => {
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
            window.livewire.on('modal-locacion', msg => {
                $('#theModal').modal('show')
            });
            window.livewire.on('modal-hide', msg => {
                $('#theModal').modal('hide')
            });
            window.livewire.on('verprod', function(e) {
                $('#verproductos').modal('show')
            });
            window.livewire.on('show-modal', msg => {
                $('#asignar_mobiliario').modal('show')
            });

        });

        function Confirm(id, descripcion, locations) {
            if (locations > 0) {
                swal.fire({
                    title: 'PRECAUCION',
                    type: 'warning',
                    text: 'No se puede eliminar la estanteria, ' + descripcion + ' porque tiene ' +
                        locations + ' productos relacionados.'
                })
                return;
            }
            swal.fire({
                title: 'CONFIRMAR',
                type: 'warning',
                text: 'Confirmar eliminar la locacion ' + '"' + descripcion + '"',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                // cancelButtonColor: '#383838',
                // confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRow', id)
                    Swal.close()
                }
            })
        }
    </script>
@endsection