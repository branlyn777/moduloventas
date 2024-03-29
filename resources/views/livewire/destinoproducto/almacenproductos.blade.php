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
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Almacen Stock</h6>
    </nav>
@endsection


@section('Gestionproductoscollapse')
    nav-link
@endsection


@section('Gestionproductosarrow')
    true
@endsection


@section('almacenstokcnav')
    "nav-link active"
@endsection


@section('Gestionproductosshow')
    "collapse show"
@endsection

@section('almacenstokcli')
    "nav-item active"
@endsection

<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Almacen Producto</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-success mb-0"
                            href="{{ url("almacen/export/{$selected_id}/{$selected_mood}/{$search}") }}">
                            <i class="fas fa-arrow-alt-circle-up"></i> Exportar Excel</a>


                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body  p-4">

                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">
                            <h6>Buscar</h6>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="nombre producto, codigo"
                                        class="form-control ">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-md-6">

                                    <h6>Seleccionar Sucursal</h6>
                                    <select wire:model='selected_id' class="form-select">
                                        <option value="General">Todas las sucursales</option>
                                        @foreach ($data_suc as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->sucursal }}-{{ $data->destino }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-6">

                                    <h6>Filtro por Stock</h6>
                                    <select wire:model='selected_mood' class="form-select">
                                        <option value="todos">Todos</option>
                                        <option value='positivo'>Productos con stock</option>
                                        <option value='cero'>Productos agotados</option>
                                        <option value='bajo'>Productos bajo stock</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-between">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center"><b>N°</b></th>
                                    <th class="text-uppercase text-sm text-center">IMAGEN</th>
                                    <th class="text-uppercase text-sm ps-2">PRODUCTO</th>
                                    <th class="text-uppercase text-sm text-center">STOCK</th>
                                    <th class="text-uppercase text-sm text-center">CANT.MIN</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($destinos_almacen as $destino)
                                    @if ($destino->stock_s < $destino->cant_min)
                                        <tr style="font-size: 14px">
                                        @else
                                        <tr style="font-size: 14px">
                                    @endif
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-center">
                                        <span>
                                            @if ($destino->image != null)
                                                <img src="{{ asset('storage/productos/' . $destino->image) }}"
                                                    alt="hoodie" width="50">
                                            @else
                                                <img src="{{ asset('storage/productos/' . 'noimagenproduct.png') }}"
                                                    alt="hoodie" width="50">
                                            @endif
                                        </span>
                                    </td>
                                    <td style="width: 15%">
                                        <b>{{ substr($destino->nombre, 0, 58) }}</b><br>
                                        Codigo: {{ $destino->codigo }}
                                    </td>



                                    @if ($selected_id == 'General')
                                        <td class="text-center">
                                            {{ $destino->stock_s }}
                                        </td>
                                        <td class="text-center">
                                            {{ $destino->cantidad_minima }}
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:void(0)" wire:click="ver({{ $destino->id }})"
                                                class="mx-3" title="Ver">
                                                <i class="fas fa-list"></i>
                                            </a>
                                            <a href="javascript:void(0)" wire:click="lotes({{ $destino->id }})"
                                                class="mx-3" title="Lotes">
                                                <i class="fas fa-box-open text-info"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ $destino->stock }}
                                        </td>
                                        <td class="text-center">
                                            {{ $destino->cantidad_minima }}
                                        </td>
                                        @can('Admin_Views')
                                            <td class="align-middle text-center">
                                                <a href="javascript:void(0)" wire:click="ajuste({{ $destino->id }})"
                                                    title="Ajuste de inventarios" class="mx-3">
                                                    <i class="fas fa-edit" style="font-size: 14px"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $destinos_almacen->links() }}
        </div>
    </div>
    @include('livewire.destinoproducto.detallemobiliario')
    @include('livewire.destinoproducto.ajusteinventario')
    @include('livewire.destinoproducto.lotesproductos')
    @include('livewire.destinoproducto.lotecosto')
</div>


@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('show-modal', msg => {
                $('#mobil').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                $('#mobil').modal('show')

            });
            window.livewire.on('show-modal-ajuste', msg => {
                $('#ajustesinv').modal('show')
            });
            window.livewire.on('show-modal-lotes', msg => {
                $('#lotes').modal('show')
            });
            window.livewire.on('hide-modal-ajuste', msg => {
                $('#ajustesinv').modal('hide')
            });
            window.livewire.on('hide-modal-lote', msg => {
                $('#lotes').modal('hide')
            });
            window.livewire.on('show-modal-lotecosto', msg => {
                $('#lotecosto').modal('show')
            });
            window.livewire.on('hide-modal-lotecosto', msg => {
                $('#lotecosto').modal('hide')
                $('#lotecosto').modal('show')
            });

        });

        function Confirmarvaciado() {
            swal.fire({
                title: 'CONFIRMAR',
                icon: 'warning',
                text: '¿Esta seguro de vaciar el stock del almacen ?',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#383838',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('vaciarDestino')
                    Swal.close()
                }
            })
        }
    </script>
@endsection
