<div wire:ignore.self class="modal fade" id="prodprov" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Productos por Proveedor</h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 500px; padding-top: 10px;">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <label class="ml-3 mt-1" style="font-size: 1rem;">Buscar Producto</label>
                        <div class="form-group">
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search3" placeholder="Buscar Proveedor"
                                    class="form-control ">
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12 col-sm-6 col-md-6">
                        <label style="font-size: 1rem;">Filtrar por Fecha</label>
                        <div class="form-group">
                            <input type="date"  class="form-control flatpickr">
                        </div>
                    </div> --}}

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">N°</th>
                                    <th class="text-uppercase text-sm ps-2">Proveedor</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Cod. Compra</th>
                                    <th class="text-center">Fecha Compra</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($search3 != null)
                                    @foreach ($productoProveedor as $prp)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td class="text-left">
                                                {{ $prp->nombre_prov }}
                                            </td>
                                            <td class="text-center">
                                                {{ $prp->cantidad }}
                                            </td>
                                            <td class="text-center">
                                                {{ $prp->id }}
                                            </td>
                                            <td class="text-center">
                                                {{ $prp->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p></p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- {{ $productoProveedor->links() }} --}}
        </div>
    </div>
</div>