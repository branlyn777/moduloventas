<div wire:ignore.self id="detailtranferencete" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p class="text-sm mb-0">
                <h5 class="modal-title  fs-5 text-white text-sm" id="exampleModalCenterTitle">Detalle de transferencia
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">


                @if ($datalist_destino != null)

                    <div class="table-responsive">
                        <table class="table mb-4">
                            <thead>
                                <tr>
                                    <th class="text-center">N°</th>
                                    <th class="text-left">Descripcion</th>
                                    <th class="text-center">Cantidad</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datalist_destino as $ob)
                                    <tr>
                                        <td>
                                            <h6 class="text-center">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-left">{{ $ob->producto->nombre }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center">{{ $ob->cantidad }}</h6>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @endif

            </div>

            <div class="modal-footer justify-content-end">


                @if ($estado_destino == 'En transito')
                    <button class="btn btn-secondary"
                        wire:click.prevent="rechazarTransferencia({{ $this->selected_id2 }})">
                        Rechazar
                    </button>
                    <button class="btn btn-info" wire:click.prevent="ingresarProductos({{ $this->selected_id2 }})">
                        Recibir
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
