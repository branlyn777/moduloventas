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
        <h6 class="font-weight-bolder mb-0 text-white">Ajuste Inventarios</h6>
    </nav>
@endsection


@section('Gestionproductoscollapse')
    nav-link
@endsection


@section('Gestionproductosarrow')
    true
@endsection


@section('entradasalidanav')
    "nav-link active"
@endsection


@section('Gestionproductosshow')
    "collapse show"
@endsection

@section('entradasalidali')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Ajuste de Inventarios</h5>
                    </div>
             
                
            </div>
            <div class="card  mb-4">
                <div class="card-body p-3">
                    <div class="row">

                 

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Seleccione el concepto:</strong>
                                <select wire:model='concepto' class="form-select">
                                <option value="Elegir" disabled selected>Elegir</option>
             
                                    <option wire:key="foo" value='INGRESO'>Varios: Productos Defectuosos,Bonificaciones,etc</option>
                                    <option wire:key="bar" value="AJUSTE">Ajuste de inventarios</option>
                                    <option value="INICIAL">Inventario Inicial</option>
                            


                            </select>
                            @error('concepto')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <select wire:model='tipo_proceso' class="form-select">
                                <option value="null" selected disabled>Elegir</option>
                                <option value="Entrada">Entrada</option>
                                <option value="Salida">Salida</option>
                            </select>
                            @error('tipo_proceso')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Seleccione la
                                    ubicación:</strong>
                                    <select wire:model='destino' class="form-select">
                                        <option value='Elegir' disabled>Elegir</option>
                                        @foreach ($destinosp as $item)
                                            <option value="{{ $item->destino_id }}">{{ $item->sucursal }}-{{ $item->destino }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('destino')
                                        <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Observación: </strong>
                                <textarea wire:model='observacion' class="form-control" aria-label="With textarea"></textarea>
                                @error('observacion')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
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
                                    <input type="text" wire:model="searchproduct" placeholder="Buscar"
                                        class="form-control">
                                </div>
                            </div>

                            @if (strlen($searchproduct) > 0)
                                <div class="table-wrapper">
                                    <table>
                                        <thead>
                                            <tr style="font-size: 14px">
                                                <th style="width: 500px;">Producto</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sm as $prod)
                                                <tr>
                                                    <td>
                                                        <label style="font-size: 14px" type="button">{{ $prod->nombre }}({{ $prod->codigo }})</label>
                                                    </td>

                                                    <td class="text-center">
                                                        <a wire:click="addProduct({{ $prod->id }})"
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
                            <h5><b>Detalle Ajuste</b></h5>
                        </div>
                        <div class="table-responsive">
                            @if ($col->isNotEmpty())
                                <table class="table align-items-center">
                                    <thead>
                                        <tr style="font-size: 14px; color: black;">
                                            <th class="text-center">Producto</th>
                        
                                       
                                            @if ($tipo_proceso == 'Entrada')
                                            <th class="text-center">Costo</th>
                                            <th class="text-center">Precio Venta</th>
                                            @endif
                                            <th>Cantidad</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                 
                                        @foreach ($col as $prod)
                                            <tr style="font-size: 14px; color: black;">
                                                <td style="width: 60px;">
                                                    {{ $prod['product-name'] }}
                                                </td>
                                                <td>
                                                    <input type="text" id="rs{{ $prod['product_id'] }}"
                                                        wire:change="UpdateCosto({{$prod['product_id'] }}, $('#rs' + {{ $prod['product_id'] }}).val() )"
                                                        style="padding:0!important" class="form-control text-center"
                                                        value="">
                                                </td>
                                                <td>
                                                    <input type="text" id="rs{{ $prod['product_id']}}"
                                                        wire:change="UpdatePrecioVenta({{ $prod['product_id'] }}, $('#rs' + {{ $prod['product_id']}}).val() )"
                                                        style="padding:0!important" class="form-control text-center"
                                                        value="">
                                                </td>

                                                <td>
                                                    <input type="text" id="rr{{ $prod['product_id'] }}"
                                                        wire:change="UpdateQty({{ $prod['product_id'] }}, $('#rr' + {{ $prod['product_id'] }}).val() )"
                                                        style="padding:0!important" class="form-control text-center"
                                                        value="{{ $prod['cantidad'] }}">
                                                </td>

                                             
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button title="Quitar Item" href="javascript:void(0)"
                                                            wire:click="removeItem({{ $prod['product_id'] }})"
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
                                <div class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" wire:click="resetUI()"
                                            class="btn btn-danger">Vaciar</button>
                                        <button type="button" wire:click="exit()" class="btn btn-secondary"
                                            style="background-color: #373839; color: white; border-color: black;">Ir
                                            Ajuste</button>
                                        <button type="button" wire:click="guardarCompra()"
                                            class="btn btn-primary">Finalizar</button>
                                    </div>
                                </div>
                            @else
                                <div class="table-wrapper row align-items-center m-auto mb-4">
                                    <div class="col-lg-12">
                                        <div class="row justify-content-center">AGREGAR ÍTEMS</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

        
        

            window.livewire.on('operacion_fallida', event => {
                swal(
                    '¡No se puede eliminar el registro!',
                    'Uno o varios de los productos de este registro ya fueron distribuidos y/o tiene relacion con varios registros del sistema.',
                    'error'
                )
            });

            window.livewire.on('item-deleted', Msg => {
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


            window.livewire.on('confirmar', event => {

                Swal.fire({
                    title: 'Estas seguro de eliminar este registro?',
                    text: "Esta accion es irreversible y modificara la cantidad de su inventario.",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {

                        window.livewire.emit('eliminar_registro_operacion');
                        Swal.fire(
                            'Eliminado!',
                            'El registro fue eliminado con exito',
                            'success'
                        )
                    }
                })

            });
            window.livewire.on('confirmarAll', event => {

                Swal.fire({
                    title: 'Estas seguro de eliminar este registro?',
                    text: "Esta accion es irreversible",
                    type: 'warning',
                    showCancelButton: true,
                    // confirmButtonColor: '#3085d6',
                    // cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {

                        window.livewire.emit('eliminar_registro_total');
                       
                    }
                })

            });
            window.livewire.on('stock-insuficiente', event => {

                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    padding: '2em'
                });
                toast({
                    type: 'error',
                    title: 'Stock insuficiente para la salida del producto en esta ubicacion.',
                    padding: '2em',
                })
            });
            window.livewire.on('sinproductos', event => {

                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    padding: '2em'
                });
                toast({
                    type: 'error',
                    title: 'Error, No has agregado items a tu operacion',
                    padding: '2em',
                })
            });

        })
    </script>
    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
@endsection
