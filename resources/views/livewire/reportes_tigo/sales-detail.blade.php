<div wire:ignore.self class="modal fade" id="modalDetails" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        Detalle de Transacción # {{ $transaccionId }}
                    </p>
                </h1>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-sm ps-2">Tipo</th>
                                <th class="text-uppercase text-sm ps-2">Cantidad</th>
                                <th class="text-uppercase text-sm ps-2">Cartera</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($details as $d)
                                <tr>
                                    <td class="text-sm mb-0">
                                        {{ $d->tipo }}
                                    </td>
                                    <td class="text-sm mb-0">
                                        {{ $d->importe }}
                                    </td>
                                    <td class="text-sm mb-0">
                                        {{ $d->nombreCartera }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <h6>Observaciones de la transacción: </h6><br>
                            <h6>
                                @if (!empty($details))
                                    {{ $details[0]->observaciones }}
                                @endif
                            </h6>
                            @error('estado')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
