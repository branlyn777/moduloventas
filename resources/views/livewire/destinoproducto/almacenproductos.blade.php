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
            <div class="d-lg-flex my-auto p-0 mb-4">
                <div>
                    <h6 class="mb-0 text-white" style="font-size: 16px">Almacen Producto</h6>
                </div>

                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
                        <a href='{{ url('almacen/export/') }}' class="btn bg-gradient-success btn-sm mb-0"> <i
                        class="fas fa-arrow-alt-circle-up"></i> Exportar Excel</a>

                        {{-- <button href='{{ url('almacen/export/') }}' type="button" class="btn btn-success mb-0">
                            <span class="btn-inner--icon">
                                <i class="fas fa-circle-xmark me-2"></i>
                            </span class="btn-inner--text"> Exportar Excel</button> --}}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body p-4">

                    <div class="row justify-content-between mt-4">
                        <div class="col-12 col-md-3">
                            <label style="font-size: 1rem">Buscar</label>
                            <div class="input-group">
                                <span class="input-group-text input-gp">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row">
                                {{-- SELECT DE LAS SUCURSALES --}}
                                <div class="col-md-6">
                                    {{-- <div class="btn-group" role="group" aria-label="Basic mixed styles example"> </div> --}}
                                    <label style="font-size: 1rem">Seleccionar Sucursal</label>
                                    <select wire:model='selected_id' class="form-select">
                                        <option value="General">Almacen Total</option>
                                        @foreach ($data_suc as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->sucursal }}-{{ $data->destino }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label style="font-size: 1rem">Estado</label>
                                    <select wire:model='selected_mood' class="form-select">
                                        <option value="todos">TODOS</option>
                                        <option value='cero'>Productos agotados</option>
                                        <option value='bajo'>Productos bajo stock</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-left mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-sm text-center"><b>N°</b></th>
                                            <th class="text-uppercase text-sm">IMAGEN</th>
                                            <th class="text-uppercase text-sm" style="width: 50px">PRODUCTO</th>
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
                                            <td>
                                                <span>
                                                    <img src="{{ 'storage/productos/' . $destino->image }}"
                                                        height="40" class="rounded">
                                                </span>
                                            </td>
                                            <td class="text-left" style="width: 15%">
                                                <b>{{ $destino->nombre }}</b><br>
                                                Codigo: {{ $destino->codigo }}
                                            </td>
                                            {{--
                                                    <td class="text-left" style="width: 15%">
                                                    <strong class="text-left" >{{$destino->nombre}}</strong><br>
                                                    <label class="text-left"  >{{ $destino->unidad}}</label>|<label>{{ $destino->marca}}</label>|<label>{{ $destino->industria }}</label>
                                                    {{ $destino->caracteristicas }}( <b>CODIGO:</b>  {{$destino->codigo}})</td>
                                                --}}

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

                                                    <a href="javascript:void(0)"
                                                        wire:click="lotes({{ $destino->id }})" class="mx-3"
                                                        title="Lotes">
                                                        <i class="fas fa-box-open text-info"></i>
                                                    </a>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <h6 class="text-center">{{ $destino->stock }}</h6>
                                                </td>
                                                <td class="text-center">
                                                    {{ $destino->cantidad_minima }}
                                                </td>
                                                @can('Admin_Views')
                                                    <td>
                                                        <a href="javascript:void(0)"
                                                            wire:click="ajuste({{ $destino->id }})"
                                                            title="Ajuste de inventarios" class="mx-3">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </td>
                                                @endcan
                                            @endif

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $destinos_almacen->links() }}
            </div>
        </div>
    </div>
    @include('livewire.destinoproducto.detallemobiliario')
    @include('livewire.destinoproducto.ajusteinventario')
    @include('livewire.destinoproducto.lotesproductos')
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
