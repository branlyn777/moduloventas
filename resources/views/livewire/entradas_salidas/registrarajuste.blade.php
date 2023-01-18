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
@section('css')
    <style>
        .file-drop-area {
            border: 2px dashed #7c7db3;
            border-radius: 3px;
            position: relative;
            width: 90%;
            max-width: 100%;
            margin: 0 auto;
            padding: 26px 20px 30px;
            -webkit-transition: 0.2s;
            transition: 0.2s;
        }

        .file-drop-area.is-active {
            border: 1px dashed #ce2097;
        }

        .fake-btn {
            background-color: #a09faa;
            border: 1px solid #ffffff;
            border-radius: 3px;
            padding: 8px 15px;
            margin-right: 8px;
            color: #ffffff;


        }

        .file-msg {
            font-size: small;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            max-width: calc(100% - 130px);
            vertical-align: middle;
        }

        .file-input {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            cursor: pointer;
            opacity: 0;
        }

        .file-input:focus {
            outline: none;
        }
    </style>
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
                    <div class="multisteps-form mb-5">

                        <div class="row">
                            <div class="col-12 col-lg-12 mx-auto my-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="multisteps-form__progress">
                                            <button  class=@yield('entradasalidali', 'multisteps-form__progress-btn ')
                                                title="User Info">
                                                <span>Datos</span>
                                            </button>
                                            <button class="multisteps-form__progress-btn" type="button"
                                                title="Address">Ubicacion</button>
                                            <button class="multisteps-form__progress-btn" type="button"
                                                title="Socials">Operacion</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12 m-auto">
                                <form class="multisteps-form__form mb-8" style="height: 408px;">

                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                        data-animation="FadeIn">
                                        @section('entradasalidali')
                                        multisteps-form__progress-btn js-active
                                        @endsection
                                        <div class="multisteps-form__content">
                                            <div class="row mt-4 p-2">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                     
                                                        <div class="form-group">
                                                            <strong style="color: rgb(74, 74, 74)">Seleccione el
                                                                concepto:</strong>
                                                            <select wire:model='concepto' class="form-select">
                                                                <option value="Elegir" disabled selected>Elegir</option>

                                                                <option wire:key="bar" value="AJUSTE">Ajustar
                                                                    inventarios
                                                                </option>
                                                                <option value="INICIAL">Inventario Inicial</option>
                                                                <option wire:key="foo" value='INGRESO'>Varios: Productos
                                                                    Defectuosos,Bonificaciones,etc</option>



                                                            </select>
                                                            @error('concepto')
                                                                <span class="text-danger er"
                                                                    style="font-size: 0.8rem">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        @if ($concepto == 'INGRESO')

                                                            <div class="col-12 col-sm-12 col-md-12">
                                                                <strong style="color: rgb(74, 74, 74)">Seleccione el
                                                                    tipo de
                                                                    operacion:</strong>
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
                                                            
                                                        <div class="col-12 col-sm-12 col-md-12">
                                                            <label style="color: rgb(74, 74, 74)">Tipo de registro</label>
                                                            <select wire:model='registro' class="form-select">
                                                                <option value="Manual" selected>Registrar Manual</option>
                                                                @if ($concepto == 'INICIAL')
                                                                    <option value="Documento">Registro Masivo (Subir Documento
                                                                        Excel)</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>




                                            </div>

                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                    type="button" title="Next">Siguiente</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                        data-animation="FadeIn">
                                        {{-- <h5 class="font-weight-bolder">Address</h5> --}}
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="col-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong style="color: rgb(74, 74, 74)">Seleccione la
                                                                sucursal:</strong>
                                                            <select wire:model.lazy='sucursal' class="form-select">
                                                                <option value='Elegir' disabled>Elegir</option>
                                                                @foreach ($sucursales as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('destino')
                                                                <span class="text-danger er"
                                                                    style="font-size: 0.8rem">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <strong style="color: rgb(74, 74, 74)">Seleccione el
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

                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                    title="Prev">Anterior</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                    type="button" title="Next">Siguiente</button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white h-100"
                                        data-animation="FadeIn">

                                        <div class="multisteps-form__content mt-3">
                                            <div class="row">
                                                @if ($concepto == 'INICIAL' and $registro == 'Documento')





                                                    <form wire:submit.prevent="import()" method="POST"
                                                        enctype="multipart/form-data">
                                                        <div class="file-drop-area">
                                                            <span class="fake-btn">Elegir Documento</span>
                                                            <span class="file-msg js-set-number">Arrastre su documento
                                                                aqui.</span>
                                                            <input class="file-input" wire:model='archivo'
                                                                type="file" accept=".xlsx" multiple>
                                                        </div>
                                                        <div style="text-align: right">
                                                            <button class="btn btn-sm btn-success mt-1"
                                                                type="submit">Subir Archivo</button>
                                                        </div>

                                                    </form>




                                                    @if ($failures)
                                                        <div>
                                                            @foreach ($failures as $failure)
                                                                @foreach ($failure->errors() as $error)
                                                                    <li>{{ $error }},numero de fila
                                                                        {{ $failure->row() }}.</li>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @endif
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
                                                        <div class="card"><br>
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
                                                                                        @endif
                                                                                        @if ($concepto == 'AJUSTE')
                                                                                            <td>

                                                                                            </td>
                                                                                            <td>

                                                                                            </td>
                                                                                        @endif
                                                                                        <td>
                                                                                            <input type="text"
                                                                                                id="pq{{ $prod['product_id'] }}"
                                                                                                wire:change="UpdateQty({{ $prod['product_id'] }}, $('#pq' + {{ $prod['product_id'] }}).val() )"
                                                                                                style="padding:0!important"
                                                                                                class="form-control text-center"
                                                                                                value="{{ $prod['cantidad'] }}">
                                                                                        </td>

                                                                                        <td class="text-center">
                                                                                            <div class="btn-group"
                                                                                                role="group"
                                                                                                aria-label="Basic example">
                                                                                                <button
                                                                                                    title="Quitar Item"
                                                                                                    href="javascript:void(0)"
                                                                                                    wire:click="removeItem({{ $prod['product_id'] }})"
                                                                                                    class="btn btn-danger"
                                                                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                                                    <i
                                                                                                        class="fas fa-trash-alt"></i>
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
                                                        @if ($col->isNotEmpty())
                                                            <div class="text-center mt-2">
                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">
                                                                    <button type="button" wire:click="resetUI()"
                                                                        class="btn btn-danger">Vaciar</button>
                                                                    <button type="button" wire:click="exit()"
                                                                        class="btn btn-primary">Ir
                                                                        Ajuste</button>
                                                                    <button type="button"
                                                                        wire:click="GuardarOperacion()"
                                                                        class="btn btn-success">Finalizar</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                    title="Prev">Anterior</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0" type="button"
                                                    title="Send">Guardar</button>
                                            </div>
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
                    title: 'Existe un error al subir el archivo, vuelva a intentarlo',
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
    </script>

    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>

    <script src="{{ asset('js/plugins/multistep-form.js') }}"></script>
@endsection
