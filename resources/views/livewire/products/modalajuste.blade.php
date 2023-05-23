<div wire:ignore.self class="modal fade" id="ajusteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Ajustar Cantidad</h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <u>
                    <h5 class="text-center">{{ $prod_name }}</h5>
                </u>
                <div class="row">

                    <div class="col-6">

                        <div class="form-group">

                            <label>Sucursal</label>
                            <div class="input-group">
                            

                                <select wire:model='sucursalAjuste' class="form-select">
                                    <option value=null selected disabled>Elegir Sucursal</option>
                                    @foreach ($sucursales as $suc)
                                        <option value="{{ $suc->id }}">{{ $suc->name }}</option>
                                    @endforeach
                            
                                </select>

                            </div>
                        </div>

                    </div>
                    <div class="col-6">

                        <div class="form-group">

                            <label>Ubicacion</label>
                            <div class="input-group">
                                <select wire:model='destinoAjuste' class="form-select">
                                    <option value=null selected disabled>Elegir Ubicacion</option>
                                    @foreach ($destinos as $destino)
                                        <option value="{{ $destino->id }}">{{ $destino->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">

                        <div class="form-group">

                            <label>Cantidad Sistema</label>
                            <div class="input-group">
                                <input type="number" style="max-height: 33px;" wire:model="prod_stock"
                                    class="form-control">

                                <span class="input-group-text">Uds.</span>

                            </div>
                        </div>

                    </div>

                    <div class="col-6">

                        <div class="form-group">

                            <label>Recuento Fisico</label>
                            <div class="input-group">
                                <input type="number" style="max-height: 33px;" wire:model="nuevo_cantidad"
                                    class="form-control">

                                <span class="input-group-text">Uds.</span>

                            </div>
                            @error('nuevo_cantidad')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">

                            <label>Costo Unit.</label>
                            <div class="input-group">
                                <input type="number" style="max-height: 33px;" wire:model.lazy="costoAjuste"
                                    class="form-control" placeholder="--"
                                    {{ $nuevo_cantidad > $prod_stock ? '' : 'disabled=true' }}>

                                <span class="input-group-text">Bs</span>

                            </div>
                        </div>
                        @error('costoAjuste')
                            <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="col-6">
                        <div class="form-group">

                            <label>Precio V.</label>
                            <div class="input-group">
                                <input type="number" style="max-height: 33px;" wire:model.lazy="pv_lote"
                                    class="form-control" placeholder="--"
                                    {{ $nuevo_cantidad > $prod_stock ? '' : 'disabled=true' }}>

                                <span class="input-group-text">Bs</span>

                            </div>
                        </div>
                        @error('pv_lote')
                            <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div class="row">

                </div>
                <div class="row">
                    <div class="col">
                        <label for="floatingTextarea">Observacion:</label>
                        <textarea wire:model.lazy="observacion" class="form-control" placeholder="Agregar una observacion"
                            id="floatingTextarea"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetAjuste" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancelar</button>
                <button wire:click.prevent="guardarAjuste()" type="button" class="btn btn-primary"
                    style="font-size: 13px">Guardar Ajuste</button>
            </div>
        </div>
    </div>
</div>
