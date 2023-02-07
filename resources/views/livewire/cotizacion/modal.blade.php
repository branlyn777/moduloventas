<div wire:ignore.self class="modal fade" id="modalbuscarproducto" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        Buscar Producto
                    </p>
                </h1>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">






                <div class="card mb-4">

                    <div class="col-sm-12">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="buscarproducto" placeholder="Buscar o Producto..."
                                    class="form-control ">
                            </div>
                        </div>
                        <br>

                        <div class="card mb-4">
                            <div class="card-body px-0 pt-0 pb-2">
                                @if (strlen($this->buscarproducto) > 0)
                                    <div id="slide">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <p class="text-uppercase text-sm ps-2 text-left"><b>Nombre
                                                                Producto</b></p>
                                                    </th>
                                                    <th>
                                                        <p class="text-uppercase text-sm ps-2 text-center">
                                                            <b>Seleccionar</b>
                                                        </p>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listaproducto as $lp)
                                                    <trcla class="text-left">
                                                        <td class="text-sm mb-0 text-left">
                                                            {{ ucwords(strtolower(substr($lp->nombre, 0, 85))) }}
                                                        </td>
                                                        <td class="text-sm ps-0 text-center">
                                                            <button title="Seleccionar Producto"
                                                                wire:click.prevent="increase({{ $lp->id }})"
                                                                class="btn btn-primary"
                                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                <i class="fas fa-check"></i>
                                                            </button>
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
                </div>





                @if ($this->carrito_cotizacion->count() > 0)
                    <table class="table table-wrapper">
                        <thead>
                            <tr>
                                <th class="text-sm mb-0">N°</th>
                                <th class="text-sm mb-0">Nombre</th>
                                <th class="text-sm mb-0">Codigo</th>
                                <th class="text-sm mb-0">Cantidad</th>
                                <th class="text-sm mb-0">Precio</th>
                                <th class="text-sm mb-0">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->carrito_cotizacion->sortBy('orden') as $c)
                                <tr>
                                    <td class="text-sm mb-0 text-center">
                                        {{ $c['orden'] }}
                                    </td>
                                    <td class="text-sm mb-0 text-center">
                                        {{ $c['nombre_producto'] }}
                                    </td>
                                    <td class="text-sm mb-0 text-center">
                                        {{ $c['codigo'] }}
                                    </td>
                                    <td class="text-sm mb-0 text-center">
                                        {{ $c['cantidad'] }}
                                    </td>
                                    <td class="text-sm mb-0 text-center">
                                        {{ $c['precio_producto'] }}
                                    </td>
                                    <td class="text-sm mb-0 text-center">

                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            <button title="Quitar una unidad"
                                                wire:click.prevent="decrease({{ $c['producto_id'] }})"
                                                class="btn btn-secondary"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button title="Incrementar una unidad"
                                                wire:click.prevent="increase({{ $c['producto_id'] }})"
                                                class="btn btn-primary"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button title="Eliminar Producto" href="#"
                                                onclick="ConfirmarEliminar('  {{ $c['producto_id'] }}', '{{ $c['nombre_producto'] }}')"
                                                class="btn btn-danger"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive p-0">
                                    <table style="width: 100%">

                                        <tr>
                                            <td colspan="3">
                                                <h5>
                                                    <p class="text-sm mb-0">
                                                        <b> Totales.- </b>
                                                    </p>
                                                </h5>
                                            </td>
                                            <td class="text-left">
                                                <p class="text-sm mb-0">
                                                <h6>{{ number_format($this->total_cantidad) }}</h6>
                                                </p>
                                            </td>
                                            <td class="text-left">
                                                <p class="text-sm mb-0">
                                                <h6>{{ number_format($this->total_bs, 2) }} Bs</h6>
                                                </p>
                                            </td>

                                            <td class="text-center">
                                                <p class="text-sm mb-0">
                                                    <b>---</b>
                                                </p>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                    </table>
                @endif





            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar Ventana</button> --}}
            </div>
            <br>
        </div>
    </div>
</div>
