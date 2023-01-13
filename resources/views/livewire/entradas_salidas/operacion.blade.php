<div wire:ignore.self class="modal fade" id="operacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="text-white" id="exampleModalCenterTitle">Entrada/Salida de Productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if ($nextpage != true)
                        <div class="col-md-6">
                            <label>Seleccione un tipo de operación:</label>

                            <select wire:model='tipo_proceso' class="form-select">
                                <option value="null" selected disabled>Elegir</option>
                                <option value="Entrada">Entrada</option>
                                <option value="Salida">Salida</option>
                            </select>
                            @error('tipo_proceso')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label style="color: rgb(74, 74, 74)"><span class="text-warning">* </span>Seleccione el
                                concepto:</label>
                            <select wire:model='concepto' class="form-select"
                                {{ $tipo_proceso == null ? 'disabled=true' : '' }}>
                                <option value="Elegir" disabled selected>Elegir</option>
                                @if ($tipo_proceso == 'Entrada')
                                    <option wire:key="foo" value='INGRESO'>Varios: Bonificaciones,etc</option>
                                    <option wire:key="bar" value="AJUSTE">Ajuste de inventarios
                                    </option>
                                @else
                                    <option wire:key="gj" value="SALIDA">Varios: Regalos,etc</option>
                                    <option wire:key="kl" value="AJUSTE">Ajuste de inventarios
                                    </option>
                                @endif


                                @if ($tipo_proceso == 'Entrada')
                                    <option value="INICIAL">Inventario Inicial</option>
                                @endif


                            </select>
                            @error('concepto')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label style="color: rgb(74, 74, 74)"><span class="text-warning">* </span>Seleccione la
                                ubicación:</label>
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





                        <div class="col-md-6 mb-2">
                            <label style="color: rgb(74, 74, 74)"><span class="text-warning">* </span>Agregue una
                                observación:</label>


                            <textarea class="form-control" wire:model='observacion' cols="10" rows="1"></textarea>

                            @error('observacion')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        {{-- Proxima pagina del modal --}}
                        <div class="col-md-5">
                            <label style="color: rgb(74, 74, 74)">Tipo de registro</label>
                            <select wire:model='registro' class="form-select">
                                <option value="Manual" selected>Registrar Manual</option>
                                @if ($concepto == 'INICIAL')
                                    <option value="Documento">Registro Masivo (Subir Documento Excel)</option>
                                @endif
                            </select>

                            @if ($registro == 'Documento')
                                <form wire:submit.prevent="import('{{ $archivo }}')" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div>

                                        {{ $archivo }}
                                        <center>
                                            <div wire:loading wire:target="archivo">
                                                <div class="d-flex align-items-center">
                                                    <strong>Cargando Archivo, Espere por favor...</strong>
                                                    <div class="spinner-border ms-auto"></div>
                                                </div>
                                            </div>
                                        </center>

                                    </div>
                                    <label for="">Archivo Seleccionado</label>
                                    <input type="file" class="form-control" name="import_file"
                                        wire:model="archivo" />


                                </form>
                            @endif
                        </div>


                    @endif






                </div>

                @if ($registro == 'Manual' and $nextpage == true)

                    <div class="row mt-4">

                        <div class="col-sm-12 col-md-6">
                            <div>

                                <div class="form-group">
                                    <label>
                                        Producto
                                    </label>
                                    @if ($result)
                                        <div class="input-group">


                                            <input type="text" wire:model="result" placeholder="Buscar"
                                                class="form-control">
                                            <button type="button" class="btn btn-warning" wire:click="deleteItem()">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            @error('result')
                                                <span class="text-danger er"
                                                    style="font-size: 0.8rem">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @else
                                        <input wire:model="searchproduct" class="form-control">
                                        @error('result')
                                            <span class="text-danger er"
                                                style="font-size: 0.8rem">{{ $message }}</span>
                                        @enderror
                                    @endif

                                </div>
                            </div>
                            @if ($buscarproducto != 0)
                                <div class="col-sm-12 col-md-12">
                                    <div class="vertical-scrollable">
                                        <div class="row layout-spacing">
                                            <div class="col-md-12 ">
                                                <div class="statbox widget box box-shadow">
                                                    <div class="widget-content widget-content-area row">
                                                        <div class="table-responsive">
                                                            <table class="table table-sm" style="width:100%">

                                                                <tbody>
                                                                    @foreach ($sm as $d)
                                                                        <tr>
                                                                            <td class="text-center">
                                                                                <h6 class="text-center">
                                                                                    {{ $d->nombre }}
                                                                                </h6>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <a href="javascript:void(0)"
                                                                                    wire:click="Seleccionar('{{ $d->id }}')"
                                                                                    class="btn btn-warning mtmobile"
                                                                                    title="Seleccionar">
                                                                                    <i class="fas fa-check"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-2 ml-1 p-0">
                            <div class="form-group">
                                <label>
                                    Cantidad
                                </label>
                                <input type="number" wire:model="cantidad" class="form-control">
                                @error('cantidad')
                                    <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if ($tipo_proceso == 'Entrada')
                            <div class="col-lg-2 ml-1 p-0">
                                <div class="form-group">
                                    <label>
                                        Costo/Valor
                                    </label>
                                    <input wire:model="costo" class="form-control  mx-1">
                                    @error('costo')
                                        <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-2 ml-1 mt-3 pt-3">
                            <div class="form-group">

                                <button type="button" wire:click="addProduct({{ $selected }})"
                                    title="Agregar producto a la lista" class="btn btn-primary"
                                    style="width: 6rem"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                @endif
                {{-- lista de productos de la operacion si no es un documento de excel --}}
                @if ($nextpage == true)
                    <div class="row">
                        <div class="card-body p-4">
                            <div class="title">
                                <h6 class="text-left">Lista de Productos</h6>
                                <hr style="height: 3px; background-color: black">
                            </div>
                            <div class="table-responsive">

                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">N°</th>
                                            <th>Producto</th>
                                            @if ($tipo_proceso != 'Salida')
                                                <th class="text-center">Costo</th>
                                            @endif
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Acc.</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($col) > 0)
                                            @foreach ($col as $key => $value)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $value['product-name'] }}
                                                    </td>

                                                    @if ($tipo_proceso != 'Salida')
                                                        <td class="text-center">
                                                            {{ $value['costo'] }}
                                                        </td>
                                                    @endif

                                                    <td class="text-center">
                                                        {{ $value['cantidad'] }}
                                                    </td>
                                                    <td class="text-center">


                                                        <a type="button" wire:key="{{ $loop->index }}"
                                                            wire:click="eliminaritem({{ $value['product_id'] }})"
                                                            class="mx-3" title="Quitar producto de la lista">
                                                            <i class="fas fa-times text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">
                                                    <div
                                                        class="row justify-content-center align-items-center mx-auto my-5">

                                                        <label class="text-center">S/N ITEMS</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                @endif
            </div>
            {{-- fin  lista de productos de la operacion --}}



            <div class="modal-footer">
                <button type="button" wire:click="Exit()" class="btn btn-secondary close-btn"
                    data-bs-dismiss="modal">Cancelar</button>

                @if ($nextpage == false)
                    <button type="button" wire:click="ValidarDatos()"
                        class="btn btn-primary close-btn">Siguiente</button>
                @else
                    <button type="button" wire:click="GuardarOperacion()"
                        class="btn btn-primary close-btn">Guardar</button>
                @endif

            </div>

        </div>

    </div>

</div>
