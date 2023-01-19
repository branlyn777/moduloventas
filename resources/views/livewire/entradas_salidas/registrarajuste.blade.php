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

            <div class="row mb-5">
                <div class="col-12">
                    <div wire:ignore.self class="multisteps-form mb-5">

                        <div class="row">
                            <div class="col-12 col-lg-10 mx-auto my-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="multisteps-form__progress">
                                            <button class='multisteps-form__progress-btn {{ $active1 }}'
                                                title="User Info" style="pointer-events: none">
                                                <span>Datos</span>
                                            </button>
                                            <button class="multisteps-form__progress-btn {{ $active2 }}"
                                                type="button" title="Address"
                                                style="pointer-events: none">Ubicacion</button>
                                            <button class="multisteps-form__progress-btn {{ $active3 }}"
                                                type="button" title="Socials"
                                                style="pointer-events: none">Operacion</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-10 m-auto">
                                <form class="multisteps-form__form mb-8" style="height: 408px;">

                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white {{ $show }}"
                                        data-animation="FadeIn">

                                        <div class="multisteps-form__content">
                                            <div class="row mt-4 p-2">
                                                <div class="col-md-12">
                                                    <div class="row justify-content-center">

                                                        <div class="col-md-6">

                                                            <div class="form-group">
                                                                <label style="color: rgb(74, 74, 74)"><span
                                                                        class="text-warning">* </span>Seleccione el
                                                                    concepto::</label>
                                                                <select wire:model='concepto' class="form-select">
                                                                    <option value="Elegir" disabled selected>Elegir
                                                                    </option>

                                                                    <option wire:key="bar" value="AJUSTE">Ajustar
                                                                        inventarios
                                                                    </option>
                                                                    <option value="INICIAL">Inventario Inicial</option>
                                                                    <option wire:key="foo" value='INGRESO'>Varios:
                                                                        Productos
                                                                        Defectuosos,Bonificaciones,etc</option>



                                                                </select>
                                                                @error('concepto')
                                                                    <span class="text-danger er"
                                                                        style="font-size: 0.8rem">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row justify-content-center">

                                                        @if ($concepto == 'INGRESO')

                                                            <div class="col-12 col-sm-12 col-md-6">
                                                                <label style="color: rgb(74, 74, 74)"><span
                                                                        class="text-warning">* </span>Tipo
                                                                    Operacion:</label>
                                                                <select wire:model='tipo_proceso' class="form-select">
                                                                    @if ($concepto == 'INGRESO')
                                                                        <option value="null" selected disabled>Elegir
                                                                        </option>
                                                                        <option value="Entrada">Entrada</option>
                                                                        <option value="Salida">Salida</option>
                                                                    @else
                                                                        <option value="null" selected disabled>--
                                                                        </option>
                                                                    @endif

                                                                </select>
                                                                @error('tipo_proceso')
                                                                    <span class="text-danger er"
                                                                        style="font-size: 0.8rem">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        @endif
                                                        @if ($concepto == 'INICIAL')

                                                            <div class="col-12 col-sm-12 col-md-6">
                                                                <label style="color: rgb(74, 74, 74)">Tipo de
                                                                    registro</label>
                                                                <select wire:model='registro' class="form-select">
                                                                    <option value="Manual" selected>Registrar Manual
                                                                    </option>
                                                                    @if ($concepto == 'INICIAL')
                                                                        <option value="Documento">Registro Masivo (Subir
                                                                            Documento
                                                                            Excel)</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6 mb-2">
                                                            <label style="color: rgb(74, 74, 74)"><span
                                                                    class="text-warning">* </span>Agregue una
                                                                observación:</label>


                                                            <textarea class="form-control" wire:model='observacion' cols="10" rows="1"></textarea>

                                                            @error('observacion')
                                                                <span class="text-danger er"
                                                                    style="font-size: 0.8rem">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0" type="button"
                                                    title="Next" wire:click='proxima()'>Siguiente</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white {{ $show1 }}"
                                        data-animation="FadeIn">
                                        {{-- <h5 class="font-weight-bolder">Address</h5> --}}
                                        <div class="multisteps-form__content">
                                            <div class="row mt-4 p-2">
                                                <div wire:ignore.self class="col-md-12">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <strong style="color: rgb(74, 74, 74)"><span class="text-warning">* </span> Seleccione la
                                                                    sucursal:</strong>
                                                                <select wire:model.lazy='sucursal' class="form-select">
                                                                    <option value='Elegir' disabled>Elegir</option>
                                                                    @foreach ($sucursales as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <strong style="color: rgb(74, 74, 74)"><span class="text-warning">* </span>Seleccione el
                                                                    almacen:</strong>
                                                                <select wire:model.lazy='destino' class="form-select">
                                                                    <option value=null disabled>--</option>
                                                                    @foreach ($destinos as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('destino')
                                                                    <span class="text-danger er"
                                                                        style="font-size: 0.8rem">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-light mb-0" type="button"
                                                    title="Prev">Anterior</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0" type="button"
                                                    title="Next" wire:click='proxima2()'>Siguiente</button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white h-100 {{ $show2 }}"
                                        data-animation="FadeIn">

                                        <div class="multisteps-form__content mt-3">
                                            <div class="row">
                                                @if ($concepto == 'INICIAL' and $registro == 'Documento')




                                                    <form>

                                                        <div>


                                                            <center>
                                                                <div wire:loading wire:target="archivo">
                                                                    <div class="d-flex align-items-center">
                                                                        <strong>Cargando Archivo, Espere por
                                                                            favor...</strong>
                                                                        <div class="spinner-border ms-auto"></div>
                                                                    </div>
                                                                </div>
                                                            </center>

                                                        </div>
                                                        <label for="">Archivo Seleccionado</label>
                                                        <input type="file" class="form-control" name="import_file"
                                                            wire:model.lazy="archivo" wire:click='resetes()' />
                                                    </form>
                                                @else
                                                    <div class="col-4">
                                                        <div class="card">

                                                            <div class="form-group">
                                                                <div class="input-group mb-4">
                                                                    <span class="input-group-text">
                                                                        <i class="fa fa-search"></i>
                                                                    </span>
                                                                    <input type="text" wire:model="searchproduct"
                                                                        placeholder="Buscar" class="form-control">
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
                                                                                        <label style="font-size: 14px"
                                                                                            type="button">{{ substr($prod->nombre, 0, 40) }}({{ $prod->codigo }})</label>
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
                                                    <div class="col-8">
                                                        <div class="card">
                                                            <div class="text-center">
                                                                <h5><b>Detalle Ajuste</b></h5>
                                                            </div>
                                                            <div class="table-responsive">
                                                                @if ($col->isNotEmpty())
                                                                    <div class="table-wrapper">
                                                                        <table class="table align-items-center">
                                                                            <thead>
                                                                                <tr
                                                                                    style="font-size: 14px; color: black;">
                                                                                    <th class="text-center">Producto
                                                                                    </th>
                                                                                    @if ($tipo_proceso == 'Entrada' or $concepto == 'INICIAL')
                                                                                        <th class="text-center">Costo
                                                                                        </th>
                                                                                        <th class="text-center">Precio
                                                                                            Venta</th>
                                                                                        <th>Cantidad</th>
                                                                                        <th>Acción</th>
                                                                                    @elseif($concepto == 'AJUSTE')
                                                                                        <th>Cantidad Actual Sistema</th>
                                                                                        <th>Conteo Manual</th>
                                                                                        <th>Acción</th>
                                                                                    @else
                                                                                        <th>Cantidad</th>
                                                                                        <th>Acción</th>
                                                                                    @endif
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                                @foreach ($col as $prod)
                                                                                    <tr
                                                                                        style="font-size: 14px; color: black;">
                                                                                        <td style="width: 60px;">
                                                                                            {{ substr($prod['product_name'], 0, 90) }}
                                                                                        </td>
                                                                                        @if ($tipo_proceso == 'Entrada' or $concepto == 'INICIAL')
                                                                                            <td>
                                                                                                <input type="text"
                                                                                                    id="pc{{ $prod['product_id'] }}"
                                                                                                    wire:change="UpdateCosto({{ $prod['product_id'] }}, $('#pc' + {{ $prod['product_id'] }}).val())"
                                                                                                    style="padding:0!important"
                                                                                                    class="form-control text-center"
                                                                                                    value="{{ $prod['costo'] }}">
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text"
                                                                                                    id="pv{{ $prod['product_id'] }}"
                                                                                                    wire:change="UpdatePrecioVenta({{ $prod['product_id'] }}, $('#pv' + {{ $prod['product_id'] }}).val() )"
                                                                                                    style="padding:0!important"
                                                                                                    class="form-control text-center"
                                                                                                    value="{{ $prod['precioventa'] }}">
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="number"
                                                                                                id="pq{{ $prod['product_id'] }}"
                                                                                                wire:change="UpdateQty({{ $prod['product_id'] }}, $('#pq' + {{ $prod['product_id'] }}).val())"
                                                                                                style="padding:0!important"
                                                                                                class="form-control text-center"
                                                                                                value="{{ $prod['cantidad'] }}">
                                                                                        </td>
                                                                                        
                                                                                        @elseif ($concepto == 'AJUSTE')
                                                                                            <td>
                                                                                               
                                                                                                {{ $prod['stockactual'] }}
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="number"
                                                                                                id="cf{{ $prod['product_id'] }}"
                                                                                                wire:change="UpdateRecuento({{ $prod['product_id'] }}, $('#cf' + {{ $prod['product_id'] }}).val())"
                                                                                                style="padding:0!important"
                                                                                                class="form-control text-center"
                                                                                                value="{{ $prod['recuento'] }}">
                                                                                            </td>
                                                                                        @else
                                                                                            <td>
                                                                                                <input type="number"
                                                                                                id="pq{{ $prod['product_id'] }}"
                                                                                                wire:change="UpdateQty({{ $prod['product_id'] }}, $('#pq' + {{ $prod['product_id'] }}).val())"
                                                                                                style="padding:0!important"
                                                                                                class="form-control text-center"
                                                                                                value="{{ $prod['cantidad'] }}">
                                                                                        </td>

                                                                                        @endif
                                                                                        <td class="text-center">
                                                                                            <div class="btn-group"
                                                                                                role="group"
                                                                                                aria-label="Basic example">
                                                                                                <button
                                                                                                title="Quitar Item"
                                                                                                    type="button"
                                                                                                    onclick="ConfirmarEliminar('{{ $prod['product_id'] }}')"
                                                                                                    class="btn btn-danger"
                                                                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                                                    <i
                                                                                                        class="fas fa-trash"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach


                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="table-wrapper row align-items-center m-auto mb-4">
                                                                        <div class="col-lg-12">
                                                                            <div class="row justify-content-center">
                                                                                AGREGAR
                                                                                ÍTEMS</div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>



                                                        </div>

                                                @endif
                                            </div>

                                            @if ($failures != false)
                                                <div>
                                                    @foreach ($failures as $failure)
                                                        @foreach ($failure->errors() as $error)
                                                            <li>{{ $error }},numero de fila
                                                                {{ $failure->row() }}.</li>
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                            @endif

                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-light mb-0" type="button"
                                                    title="Prev">Anterior</button>
                                                @if ($archivo)
                                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="button"
                                                        wire:click='GuardarSubir()' title="Send">Guardar y Subir
                                                        Archivo</button>
                                                @else
                                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="button"
                                                        wire:click='GuardarOperacion()'
                                                        title="Send">Guardar</button>
                                                @endif

                                            </div>

                                        </div>

                                </form>
                            </div>
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

            window.livewire.on('operacion-added', Msg => {
                $('#operacion').modal('hide');
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

            window.livewire.on('error_salida', Msg => {

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
            window.livewire.on('errorarchivo', event => {

                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    padding: '2em'
                });
                toast({
                    type: 'error',
                    title: 'Existe un error al subir el archivo o el formato no es el adecuado, vuelva a intentarlo',
                    padding: '2em',
                })
            });
            window.livewire.on('sinarchivo', event => {

                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    padding: '2em'
                });
                toast({
                    type: 'error',
                    title: 'No ha seleccionado ningun archivo para subir',
                    padding: '2em',
                })
            });


        })

        function ConfirmarEliminar(idproducto) {


            window.livewire.emit('clear-Product', idproducto)


        }
    </script>

    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>

    <script src="{{ asset('js/plugins/multistep-form.js') }}"></script>
@endsection
