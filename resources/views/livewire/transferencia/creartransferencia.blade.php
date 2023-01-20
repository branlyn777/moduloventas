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
        <h6 class="font-weight-bolder mb-0 text-white">Transferencias</h6>
    </nav>
@endsection


@section('Gestionproductoscollapse')
    nav-link
@endsection


@section('Gestionproductosarrow')
    true
@endsection


@section('tranferenciasnav')
    "nav-link active"
@endsection


@section('Gestionproductosshow')
    "collapse show"
@endsection

@section('tranferenciasli')
    "nav-item active"
@endsection

<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex my-auto p-0 mb-4">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Transferencia Producto</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        {{-- <a class="btn btn-add mb-0" data-bs-toggle="modal" data-bs-target="#theModal" wire:click="resetUI()">
                            <i class="fas fa-plus"></i> Agregar Categoría</a> --}}
                    </div>
                </div>
            </div>
            {{-- SELECT DE LAS SUCURSALES --}}
            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="padding-left: 12px; padding-right: 12px;">

                        <div class="row justify-content-between">
                            <div class="mt-lg-0 col-md-3">
                                <label style="font-size: 1rem">Origen de transferencia:</label>
                                <select wire:model='selected_origen' {{ $itemsQuantity > 0 ? 'disabled' : '' }}
                                    class="form-select">
                                    <option value=0>Elegir Origen</option>
                                    @foreach ($data_origen as $data)
                                        <option value="{{ $data->destino_id }}">
                                            {{ $data->sucursal }}-{{ $data->destino }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-lg-0 col-md-3">
                                <label style="font-size: 1rem">Destino de transferencia:</label>
                                <select wire:model='selected_destino' class="form-select">
                                    <option value=null>Elegir Destino</option>
                                    @foreach ($data_destino as $data)
                                        <option value="{{ $data->destino_id }}">
                                            {{ $data->sucursal }}-{{ $data->destino }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-lg-0 col-md-3">
                                <div class="form-group">
                                    <label style="font-size: 1rem">Observacion:</label>
                                    <input wire:model='observacion' class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- AREA DE TRANSFERENCIAS DE PRODUCTOS --}}
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
                                </div>
                            </div>
                            @if ($selected_origen !== 0 && strlen($search) > 0)
                                <div class="table-wrapper">
                                    <table>
                                        <thead>
                                            <tr style="font-size: 14px">
                                                <th style="width: 50px;">N°</th>
                                                <th style="width: 300px;">PRODUCTO</th>
                                                <th style="width: 50px;">STOCK</th>
                                                <th class="text-center">ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($destinos_almacen as $destino)
                                                <tr style="font-size: 14px">
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ substr($destino->name, 0, 10) }}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ $destino->stock }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a wire:click="increaseQty({{ $destino->prod_id }})"
                                                            class="btn btn-primary"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <span>No se encontraron resultados</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 mb-4 mb-md-0">
                    <div class="card"><br>
                        <div class="text-center">
                            <h5><b>Detalle Transferencia</b></h5>
                        </div>
                        <div class="table-responsive">
                            @if ($cart->isNotEmpty())
                                <table class="table align-items-center mb-4">
                                    <thead>
                                        <tr style="font-size: 14px; color: black;">
                                            <th class="text-center">N°</th>
                                            <th class="text-uppercase text-sm ps-2" style="width: 600px;">Producto</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $prod)
                                            <tr style="font-size: 14px; color: black;">
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td style="width: 60px;">
                                                    {{ substr($prod->name, 0, 10) }}
                                                </td>
                                                <td>
                                                    <input type="number" onkeypress="return event.charCode >= 48"
                                                        min="1" id="rr{{ $prod->id }}"
                                                        wire:change="UpdateQty({{ $prod->id }}, $('#rr' + {{ $prod->id }}).val())"
                                                        style="padding:0!important" class="form-control text-center"
                                                        value="{{ $prod->quantity }}">
                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button title="Quitar Item" href="javascript:void(0)"
                                                            wire:click="removeItem({{ $prod->id }})"
                                                            class="btn btn-danger"
                                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="table-wrapper row align-items-center m-auto mb-4">
                                    <div class="col-lg-12">
                                        <div class="row justify-content-center">AGREGAR ITEMS</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @if ($this->itemsQuantity > 0)
                                    <button wire:click="resetUI()" class="btn btn-danger">
                                        Vaciar
                                    </button>
                                @endif
                                <a wire:click="exit()" class="btn btn-add"
                                    style="background-color: #2e48dc; color: white;">
                                    <b>Ir Transferencias</b>
                                </a>
                                <button wire:click="finalizar_tr()" class="btn btn-success">
                                    Finalizar
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('empty', msg => {
            noty(msg)
        });
        window.livewire.on('empty-destino', msg => {
            noty(msg)
        });
        window.livewire.on('no-stock', msg => {
            noty(msg)
        });
        window.livewire.on('empty_cart_tr', msg => {
            noty(msg)
        });
    });
</script>
