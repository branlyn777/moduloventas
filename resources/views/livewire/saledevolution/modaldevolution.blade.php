<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modaldevolution" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white tex-sm" id="tabsModalLabel">MODAL DEVOLUCIONES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <div class="row " style=" ">
                    <div class="col-12 text-center">
                        <p>
                        <h5>{{ $selected_product_name }}</h5>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3"></div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <span class="text-sm tex-center">
                            <b> Seleccione Accion:</b>
                        </span>
                        <br>
                        <select class="form-select">
                            <option value="">Cambiar Producto</option>
                            <option value="">Devolver Dinero</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3"></div>
                </div>




                <div class="row mb-3">

                    <div class="col-6">
                        <span class="text-sm text-center"
                            title="Seleccione el destino de donde va ha sacar el producto ">
                            <b> Devolver producto de:</b>

                        </span>
                        <select wire:model='selected_destination_id' class="form-select text-center">
                            <option value="0">seleccionar destino</option>

                            @foreach ($list_destinations as $d)
                                <option value="{{ $d->id }}"> {{ $d->nombre }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <span class="text-sm text-center"
                            title="Seleccione el destino de donde va ga guardar el prducto devuelto por el cliente.">
                            <b>Guardar producto en:</b>

                        </span>
                        <select wire:model='selected_destination_entrance_id' class="form-select text-center">
                            <option value="0">seleccionar destino</option>

                            @foreach ($list_destinations as $d)
                                <option value="{{ $d->id }}"> {{ $d->nombre }} </option>
                            @endforeach
                        </select>
                        @error('selected_destination_entrance_id')
                            <div class="form-text text-danger ">{{ $message }}</div>
                        @enderror
                    </div>

                </div>



                @if ($this->selected_destination_id != 0)
                    <div class="row">
                        <div class="col-12 text-center">
                            <b>Destino seleccionado:</b>

                            {{ $selected_destination_name }}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4"> </div>
                        <div class="col-12 col-sm-6 col-md-4 text-center">
                            <span class="text-sm "><b>
                                    cantidad:
                                </b>
                                <input wire:model='received_amount' type="number" max="2" class="form-control"
                                    value="1">
                                @error('received_amount')
                                    <div class="form-text text-danger ">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4"></div>

                    </div>
                    <br>
                    
                    <div class="row">
                        <div class="col-12 text-center">
                            <button wire:click='return_product' type="button"
                                class="btn btn-secondary">Devolver</button>
                        </div>
                    </div>
                @endif()



            </div>
        </div>
    </div>
</div>
