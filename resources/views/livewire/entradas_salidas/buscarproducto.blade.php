<div wire:ignore.self class="modal fade" id="buscarproducto" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 1rem">Detalle de Movimiento</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    @if ($detalle)
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center">N°</th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Costo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalle as $d)
                                        <tr class="text-center" style="font-size: 0.9rem">
                                            <td>
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td>
                                                {{  $d->productos->nombre}}
                                            </td>
                                            <td>
                                                {{ $d->cantidad }}
                                            </td>
                                            <td>
                                                {{ $d->costo }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>{{ $detalle }}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
