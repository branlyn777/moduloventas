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
        <h6 class="font-weight-bolder mb-0 text-white">Detalle Estanterias</h6>
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
                    <h5 class="text-white" style="font-size: 16px">Lista de Productos por Estante</h5>
                </div>
                
                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a href="javascript:void(0)" class="btn btn-secondary mb-0" wire:click='resetAsignar()'
                            data-bs-toggle="modal" wire:click="$set('selected_id', 0)" data-bs-target="#asignar_mobiliario"><i
                                class="fas fa-plus me-2"></i>Asignar Productos</a>
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
                                    <input type="text" wire:model="search"
                                        placeholder="nombre producto, codigo de producto" class="form-control">
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
                                    <th class="text-uppercase text-sm ps-2">Producto</th>
                                    <th class="text-uppercase text-sm text-center">Cantidad Total Alm.</th>
                                    <th class="text-uppercase text-sm text-center">Estantes Rel.</th>

                                    <th class="text-uppercase text-sm text-center">Acc.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $prod)
                                    <tr style="font-size: 14px">
                                        <td class="text-center">
                                            {{ ($productos->currentpage() - 1) * $productos->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td style="text-align: left">
                                            {{ $prod->nombre }}-({{ $prod->codigo }})
                                        </td>
                                        <td class="text-center">
                                            {{ $prod->cantidad }}
                                        </td>
                                        <td class="text-center">
                                            @foreach ($prod->otrosestantes as $estante)
                                                <label style="margin-left: 5px">{{ $estante->codigo }}</label>
                                            @endforeach
                                        </td>

                                        <td class="text-center">

                                            <a href="javascript:void(0)" onclick="Confirm('{{ $prod->nombre }}','{{$estante->codigo}}','{{$prod->id}}')"
                                                class="mx-3" title="Quitar producto del estante">
                                                <i class="fas fa-eraser" style="font-size: 14px"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $productos->links() }}
        </div>
    </div>
    @include('livewire.localizacion.modal_asignar_mobiliario')
</div>

@section('javascript')
    <script>
        function Confirm(nombre,mobiliario,id) {
            swal.fire({
                title: 'CONFIRMAR',
                type: 'warning',
                text: 'Esta seguro de quitar el producto' + nombre + 'del Mobiliario' + '"Cod:' + mobiliario +'"'+ '?',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('quitarProducto', id)
                    Swal.close()
                }
            });
        }
    </script>
    
    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection
