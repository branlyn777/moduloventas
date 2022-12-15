<div wire:ignore.self class="modal fade" id="buscarproducto" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="text-white" id="exampleModalCenterTitle">Detalle de Movimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($detalle)
                        <div class="col-md-12 ">
                            <div class="row m-1">

                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Costo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detalle as $d)
                                            <tr>

                                                <td class="text-center">
                                                    {{$loop->index+1}}
                                                </td>
                                                <td class="text-center">
                                                    <h6 class="text-center">{{ $d->productos->nombre}}
                                                    </h6>
                                                </td>
                                                <td class="text-center">

                                                    {{$d->cantidad}}
                                                </td>
                                                <td class="text-center">

                                                    {{$d->costo}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
