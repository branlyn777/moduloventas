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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Unidades</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Unidades y Marcas</h6>
    </nav>
@endsection


@section('Gestionproductoscollapse')
    nav-link
@endsection


@section('Gestionproductosarrow')
    true
@endsection


@section('unidadesnav')
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

@section('unidadesli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-6">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Unidades</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-add mb-0" data-bs-toggle="modal" data-bs-target="#theModal">
                            <i class="fas fa-plus"></i> Agregar Unidad</a>
                    </div>
                </div>


            </div>

            <div class="card mb-4">
                <div class="card-body  p-4">

                    <div class="row justify-content-between">
                        <div class="col-12 col-md-6">
                            <h6>Buscar</h6>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="nombre de unidad"
                                        class="form-control ">
                                </div>
                            </div>
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
                                    <th class="text-uppercase text-sm text-center">N°</th> {{-- style="width: 150px;" --}}
                                    <th class="text-uppercase text-sm ps-2">NOMBRE</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data_unidad != null and count($data_unidad) > 0)
                                    @foreach ($data_unidad as $data)
                                        <tr style="font-size: 14px">
                                            <td class="text-center">
                                                {{ ($data_unidad->currentpage() - 1) * $data_unidad->perpage() + $loop->index + 1 }}
                                            </td>
                                            <td>
                                                {{ substr($data->nombre, 0, 15) }}
                                            </td>

                                            <td class="text-center">
                                                <a href="javascript:void(0)" wire:click="Edit({{ $data->id }})"
                                                    class="mx-3" title="Editar Unidad">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $data->id }}','{{ $data->nombre }}')"
                                                    class="mx-3" title="Eliminar unidad">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <div class="row justify-content-center align-items-center mx-auto my-5">

                                                <label class="text-center">No tiene unidades que
                                                    mostrar</label>
                                            </div>
                                        </td>
                                    </tr>

                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $data_unidad->links() }}
        </div>




        <div class="col-6">
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Marcas</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-add mb-0" data-bs-toggle="modal" data-bs-target="#marca"><i
                                class="fas fa-plus"></i> Agregar Marca</a>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body  p-4">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-6">
                            <h6>Buscar Marca</h6>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search_marca" placeholder="nombre de marca"
                                        class="form-control ">
                                </div>
                            </div>
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
                                    <th class="text-uppercase text-sm text-center">N°</th>
                                    <th class="text-uppercase text-sm ps-2">NOMBRE</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($marcas != null and count($marcas) > 0)
                                @foreach ($marcas as $data)
                                    <tr style="font-size: 14px">
                                        <td class="text-center">
                                            {{ ($marcas->currentpage() - 1) * $marcas->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>
                                            {{ substr($data->nombre, 0, 15) }}
                                        </td>

                                        <td class="text-center">
                                            <a href="javascript:void(0)" wire:click="Edit_marca({{ $data->id }})"
                                                class="mx-3" title="Editar marca">
                                                <i class="fas fa-edit text-info"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                onclick="Confirm_marca('{{ $data->id }}','{{ $data->nombre }}')"
                                                class="mx-3" title="Eliminar marca">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">
                                        <div
                                            class="row justify-content-center align-items-center mx-auto my-5">

                                            <label class="text-center">No tiene marcas que
                                                mostrar</label>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $marcas->links() }}








        </div>



























    </div>
    @include('livewire.unidad.form')
    @include('livewire.unidad.formmarcas')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('unidad-added', Msg => {
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
        window.livewire.on('unidad-updated', Msg => {
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
        window.livewire.on('unidad-deleted', Msg => {
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
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('show-modal_marca', msg => {
            $('#marca').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
        $('theModal').on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none')
        })





























        //MARCA

        window.livewire.on('marca-added', Msg => {
            $('#marca').modal('hide');
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


        window.livewire.on('marca-updated', Msg => {
            $('#marca').modal('hide')
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

    });

    function Confirm(id, nombre) {

        swal.fire({
            title: 'CONFIRMAR',
            type: 'warning',
            text: 'Confirmar eliminar la unidad ' + '"' + nombre + '"',
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

    function Confirm_marca(id, nombre) {

        swal.fire({
            title: 'CONFIRMAR',
            type: 'warning',
            text: 'Confirmar eliminar la marca ' + '"' + nombre + '"',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            // cancelButtonColor: '#383838',
            // confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRowMarca', id)
                Swal.close()
            }
        })
    }
</script>
