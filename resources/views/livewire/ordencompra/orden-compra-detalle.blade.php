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
        <h6 class="font-weight-bolder mb-0 text-white"> Orden Compra</h6>
    </nav>
@endsection


@section('Comprascollapse')
    nav-link
@endsection


@section('Comprasarrow')
    true
@endsection


@section('registrarcomprasnav')
    "nav-link active"
@endsection


@section('Comprasshow')
    "collapse show"
@endsection

@section('registrarcomprasli')
    "nav-item active"
@endsection

<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0 text-white" style="font-size: 16px">Orden Compra</h5>
                    </div>

                    {{--
                        <b style="color: rgb(74, 74, 74)">Fecha: </b>
                        {{Carbon\Carbon::now()->format('Y-m-d')}}<br/>  
                        <b style="color: rgb(74, 74, 74)">Registrado por: </b> 
                        {{Auth()->user()->name}}<br/>
                    --}}

                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            {{-- <a href="javascript:void(0)" class="btn bg-gradient-light btn-sm mb-0" data-bs-toggle="modal"
                                data-bs-target="#theModal">Registrar Producto</a> --}}
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="card mb-4">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3">
                            <strong style="color: rgb(74, 74, 74)">Proveedor</strong>

                            <select wire:model.lazy="provider" class="form-select">
                                <option value=null disabled>Elegir Proveedor</option>
                                <datalist id="provider">
                                    @foreach ($data_prov as $datas)
                                        <option value="{{ $datas->nombre_prov }}">{{ $datas->nombre_prov }}</option>
                                    @endforeach
                                </datalist>
                                {{--                                                    
                                    <button data-toggle="modal" class="btn btn-dark pl-2 pr-2"
                                        data-target="#modal_prov" > <i class="fas fa-plus text-white"></i> </button> 
                                --}}
                            </select>
                            @error('provider')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-12 col-md-3">
                            <strong style="color: rgb(74, 74, 74)">Destino de la Compra</strong>
                            <select wire:model.lazy="destino" class="form-select">
                                <option value=null disabled>Elegir Destino</option>
                                @foreach ($data_suc as $data)
                                    <option value="{{ $data->destino_id }}">{{ $data->nombre }}-{{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('destino')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-12 col-md-3">
                            <strong style="color: rgb(74, 74, 74)">Observación: </strong>
                            <textarea wire:model='observacion' class="form-control" aria-label="With textarea"></textarea>
                            @error('observacion')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
                                </div>
                            </div>

                            @if (strlen($search) > 0)
                                <div class="table-wrapper">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="width: 500px">Producto</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prod as $producto)
                                                <tr>
                                                    <td>
                                                        <label style="font-size: 14px">
                                                            {{ $producto->nombre }}    ({{ $producto->codigo }})
                                                            <h6 class='text-xs'>{{ $producto->caracteristicas }}</h6>
                                                        
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <a wire:click="InsertarProducto({{ $producto->id }})"
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
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 mb-4 mb-md-0">
                    <div class="card"><br>
                        <div class="text-center">
                            <h5><b>Detalle Orden de Compra</b></h5>
                        </div>
                        <div class="table-responsive">
                            @if ($cart->isNotEmpty())
                                <table class="table align-items-center mb-4">
                                    <thead>
                                        <tr class="text-center" style="font-size: 14px; color: black;">
                                            <th class="text-uppercase text-sm text-left">Producto</th>
                                            <th class="text-uppercase text-sm ps-2">Precio Compra</th>
                                            <th class="text-uppercase text-sm text-center">Cantidad</th>
                                            <th class="text-uppercase text-sm text-center">Total</th>
                                            <th class="text-uppercase text-sm text-center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart->sortBy('order') as $prod)
                                            <tr style="font-size: 14px; color: black;">
                                                <td>
                                      

                                                    <h6 class='text-xs'>
                                                        {{ $prod['product_name'] }}
                                                    </h6>
                                                </td>

                                                <td>
                                                    <input type="text" id="r{{ $prod['product_id'] }}"
                                                        wire:change="actualizarPrecio({{ $prod['product_id'] }}, $('#r' + {{ $prod['product_id'] }}).val() )"
                                                        style="font-size: 0.8rem!important; padding:0!important"
                                                        class="form-control text-center" value="{{ $prod['price'] }}">
                                                </td>

                                                <td>
                                                    <input type="text" id="rr{{ $prod['product_id'] }}"
                                                        wire:change="actualizarCantidad({{ $prod['product_id'] }}, $('#rr' + {{ $prod['product_id'] }}).val() )"
                                                        style="font-size: 0.8rem!important; padding:0!important"
                                                        class="form-control text-center"
                                                        value="{{ $prod['quantity'] }}">
                                                </td>

                                                <td>
                                                    <h6 class="text-center">
                                                        {{ number_format($prod['quantity'] * $prod['price'], 2) }}</h6>
                                                </td>

                                                <td class="text-center">
                                                    <a href="javascript:void(0)"
                                                        wire:click="quitarProducto({{ $prod['product_id'] }})"
                                                        class="boton-rojo p-1" title="Quitar Item">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        wire:click="calcularStock({{ $prod['product_id'] }})"
                                                        class="boton-verde p-1" title="Calcular stock">
                                                        <i class="fas fa-calculator"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <h5><b>Total Bs.- {{ number_format($total, 2) }}</b></h5>
                                </div>
                            @else
                                <div class="table-wrapper row align-items-center m-auto mb-4">
                                    <div class="col-lg-12">
                                        <div class="row justify-content-center">AGREGAR ÍTEMS</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div><br>
                    <div class="text-center mb-4">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @if ($this->itemsQuantity > 0)
                                <button type="button" wire:click="resetUI()" class="btn btn-danger">Vaciar</button>
                            @endif

                            <button type="button" wire:click="exit()" class="btn btn-secondary"
                                style="background-color: #2e48dc; color: white;">Ir Orden Compras</button>

                                @if ($cart->count() > 0)
                                    
                                <button type="button" wire:click="guardarOrdenCompra()"
                                    class="btn btn-success">Finalizar</button>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.ordencompra.producto_cal')
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', msg => {
            $('#modal_calculadora').modal('show')
        });

        window.livewire.on('cantidad_ok', msg => {
            $('#modal_calculadora').modal('hide');

            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });

    });

    function Confirm(id, name, cantRelacionados) {
        if (cantRelacionados > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la empresa "' + name + '" porque tiene ' +
                    cantRelacionados + ' sucursales.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la empresa ' + '"' + name + '"?.',
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
