<div wire:ignore.self id="detailtranferencete" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p class="text-sm mb-0">
                <h5 class="modal-title  fs-5 text-white text-sm" id="exampleModalCenterTitle">Detalle de transferencia
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="min-height: 300px; padding-top: 10px;">


                @if ($datalist_destino != null)

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class=" text-sm ps-2">N°</th>
                                    <th class=" text-sm ps-2">Descripcion</th>
                                    <th class=" text-sm ps-2">Cant.</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datalist_destino as $ob)
                                    <tr>
                                        <td>
                                            <h6 class="text-center text-sm">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-left text-sm">{{ $ob->producto->nombre }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center text-sm">{{ $ob->cantidad }}</h6>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="text-center text-sm"> Total Cant.</h6>
                                    </td>
                                    <td colspan="1">
                                        <h6 class="text-center text-sm">{{$datalist_destino->sum('cantidad')}}</h6>
                                    </td>
                                </tr>
                            </tfoot>

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