<div wire:ignore.self class="modal fade" id="compraprod" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Historial de compras por producto</h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 500px; padding-top: 10px;">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <label class="ml-3 mt-1" style="font-size: 1rem;">Buscar Producto</label>
                        <div class="form-group">
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search2"
                                    placeholder="Buscar nombre,codigo producto..." class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        @if ($search2 != null)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-xs">N°</th>
                                        <th class="text-uppercase text-xs ps-2">Producto</th>
                                        <th class="text-uppercase text-xs ps-2">PROV.</th>
                                        <th class="text-center text-xs">CANT.</th>
                                        <th class="text-center text-xs">COD. COMPRA</th>
                                        <th class="text-center text-xs">FECHA COMPRA</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($compraproducto as $cp)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td class="text-left">
                                                {{ substr($cp->nombre, 0, 10) }}
                                            </td>
                                            <td class="text-left">
                                                {{ $cp->proveedor->nombre_prov }}
                                            </td>
                                            <td class="text-center">
                                                {{ $cp->cantidad }}
                                            </td>
                                            <td class="text-center">
                                                {{ $cp->id }}
                                            </td>
                                            <td class="text-center">
                                                {{ $cp->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="table-5">

                                {{ $compraproducto->links() }}
                            </div>
                        @else
                            <div class="row justify-content-center align-items-center">

                                Realice la busqueda...
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
