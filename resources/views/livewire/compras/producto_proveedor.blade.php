<div wire:ignore.self class="modal fade" id="prodprov" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Busqueda Avanzada</h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 500px; padding-top: 10px;">
                <div class="row">
                    <label class="ml-3 mt-1" style="font-size: 1rem;">Buscar por:</label>

                    <div class="col-sm-12 col-md-3 me-0 pe-0">
                        <select class="form-select me-0 pe-0" wire:model='opcionBusquedaAvanzada'
                            aria-label="Default select example">
                            <option value=null disabled>Elegir opcion</option>
                            <option value="producto">Producto</option>
                            <option value="proveedor">Proveedor</option>
                        </select>
                    </div>

                    <div class="col-md-9 ms-0 ps-0">
                        <input type="text" wire:model="search3" placeholder="Buscar Proveedor" class="form-control ">
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">





                        @if ($search3 != null)

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">N°</th>
                                            <th class="text-uppercase text-sm ps-2">Producto</th>
                                            <th class="text-center">Codigo <br> Compra</th>
                                            <th class="text-center">Precio <br> Compra</th>
                                            <th class="text-uppercase text-sm ps-2">Proveedor</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Fecha <br> Compra</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($prod as $item)
                                            <tr class="my-0 py-0 pt-0 pb-0 mt-0 mb-0">
                                                <td class="text-center text-xs">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="text-left text-xs text-wrap">
                                                    {{ $item->nombre }} ({{ $item->codigo }})
                                                </td>
                                                <td class="text-center text-xs">
                                                    {{ $item->id }}
                                                </td>
                                                <td class="text-center text-xs">
                                                    {{ $item->precio }}
                                                </td>
                                                <td class="text-left text-xs">
                                                    {{ $item->nombre_prov }}
                                                </td>
                                                <td class="text-center text-xs">
                                                    {{ $item->cantidad }}
                                                </td>

                                                <td class="text-center text-xs">
                                                    <h6 class="text-xs">
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('H:m:s') }}
                                                    </h6>

                                                    <h6 class="text-xs">
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                                    </h6>
                                                    </label>
                                                </td>
                                            </tr>






                                        @empty
                                            <p>Ningun producto encontrado.</p>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                            <div>
                                {{ $prod->links() }}
                            </div>
                        @else
                        @endif

                    </div>
                </div>
                {{-- {{ $productoProveedor->links() }} --}}
            </div>
        </div>
    </div>