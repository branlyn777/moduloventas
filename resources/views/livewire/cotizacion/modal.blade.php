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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">






                <div class="row">

                    <div class="col-sm-12">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="buscarproducto" placeholder="Buscar o Producto..."
                                    class="form-control ">
                            </div>
                        </div>
                        <br>
                        <div class="table-wrapper">
                            @if (strlen($this->buscarproducto) > 0)
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <p class="text-sm mb-0">
                                                    <b>Nombre Producto</b>
                                                </p>
                                            </th>
                                            <th class="text-center">
                                                <p class="text-sm mb-0">
                                                    <b>Seleccionar</b>
                                                </p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listaproducto as $lp)
                                            <tr>
                                                <td class="text-left">
                                                    <p class="text-sm mb-0">
                                                        {{ ucwords(strtolower(substr($lp->nombre, 0, 85))) }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
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
                            @endif
                        </div>
                    </div>
                </div>





                @if ($this->carrito_cotizacion->count() > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Acciones</th>

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
                                {{ $c['precio_producto'] }}
                            </td>
                            <td class="text-sm mb-0 text-center">
                                {{ $c['cantidad'] }}
                            </td>
                            <td class="text-sm mb-0 text-center">
                                                                
                                <div class="btn-group" role="group"
                                    aria-label="Basic example">

                                    <button title="Quitar una unidad"
                                       {{--  wire:click.prevent="decrease({{ $item->id }})" --}}
                                        class="btn btn-secondary"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button title="Incrementar una unidad"
                                       {{--  wire:click.prevent="increase({{ $item->id }})" --}}
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
