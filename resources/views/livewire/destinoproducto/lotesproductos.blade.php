<div wire:ignore.self class="modal fade" id="lotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <label class="modal-title text-white" style="font-size: 14px">Lotes</label>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                {{-- <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center" 
                    data-bs-dismiss="modal">
                    <i class="fa fas-circle-xmark text-white" aria-hidden="true">x</i>
                </button> --}}
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="d-lg-flex">
                    <div>
                        <label style="font-size: 14px">{{ $nombre_prodlote }}</label>
                    </div>

                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        @if ($loteproducto)
                            <select wire:model='estados' class="form-select">
                                <option value="null" disabled>Estado</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        @endif
                    </div>
                </div>


                <div class="card-body px-0 pb-0">


                    <div class="row">
                        <div class="col-4">

                        </div>
                        <div class="col-4 text-center">
                            <label>PRECIO DE VENTA</label>
                            <input type="number" wire:model.lazy="precio_actual"
                                style="font-size: 25px; text-align: right; margin-bottom: 10px;" class="form-control">
                            <button wire:click="actualizar_precio()" class="btn btn-success btn-sm">ACTUALIZAR
                                PRECIO</button>
                        </div>
                        <div class="col-4">

                        </div>
                    </div>


                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">N°</th>
                                            <th>Fecha Creacion</th>
                                            <th>Existencia</th>
                                            <th class="text-center">Costo Lote</th>
                                            <th>p/v Lote</th>
                                            <th class="text-center">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($loteproducto)
                                            @foreach ($loteproducto as $data)
                                                <tr style="font-size: 14px">
                                                    <td class="text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($data->created_at)->format('h:i:s a') }}
                                                    </td>
                                                    <td>
                                                        {{ $data->existencia }}
                                                    </td>
                                                    <td>
                                                        {{ $data->costo }}

                                                        @if ($this->estados == 'ACTIVO')
                                                            <div class="btn-group" role="group"
                                                                aria-label="Basic example">
                                                                {{-- <input type="number" style="text-align: right; width: 100px; border: 1px solid #d2d6da; border-radius: .5rem;" value="{{ $data->costo }}"> --}}
                                                                <button
                                                                    wire:click="modal_costo_lote({{ $data->id }})"
                                                                    type="button"
                                                                    style="background-color: #5e72e4; color: aliceblue; border-color: #5e72e4;">
                                                                    Cambiar
                                                                </button>
                                                            </div>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        {{ $data->pv_lote }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $data->status }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
