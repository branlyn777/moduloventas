<div wire:ignore.self class="modal fade" id="compraprod" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Productos por Compra</h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 500px; padding-top: 10px;">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <label class="ml-3 mt-1" style="font-size: 1rem;">Buscar</label>
                        <div class="form-group">
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search2" placeholder="producto, proveedor"
                                    class="form-control ">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">N°</th>
                                    <th class="text-uppercase text-sm ps-2">Producto</th>
                                    <th class="text-uppercase text-sm ps-2">Proveedor</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Cod. Compra</th>
                                    <th class="text-center">Fecha Compra</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($search2 != null)
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
                                @else
                                    <p></p>

                                    {{$compraproducto!=null?$compraproducto->links():''}}
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 

</div>
