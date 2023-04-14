<div wire:ignore.self class="modal fade" id="entrada_salida_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div>
                    <h5 class="mb-0 text-white" style="font-size: 16px">Entrada/Salida Productos</h5>
                </div>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <u> <h5 class="text-center">{{$prod_name}}</h5></u>
                <div class="row">
                    <div class="col">
                        <label>Tipo de Operacion</label>
                        <select wire:model="tipo_proceso" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected disabled value="null">Elegir tipo de operacion</option>
                            <option value="INGRESO">Entrada de Productos</option>
                            <option value="SALIDA">Salida de productos</option>
                         
                          </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                          <div class="form-group">

                            <label>Cantidad</label>
                            <div class="input-group">
                                <input type="number" style="max-height: 33px;" wire:model="nuevo_cantidad"
                                    class="form-control">

                                <span class="input-group-text">Uds.</span>

                            </div>
                             @error('nuevo_cantidad')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label>Cantidad</label>
                            <input type="number" wire:model.lazy="nuevo_cantidad" class="form-control">
                            @error('nuevo_cantidad')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div> --}}
                    </div>
                    @if ($tipo_proceso=='INGRESO')
                        
                    <div class="col">

                        <div class="form-group">

                            <label>Costo Unit.</label>
                            <div class="input-group">
                                <input type="number" style="max-height: 33px;" wire:model.lazy="costoAjuste"
                                    class="form-control" placeholder="--"
                             >

                                <span class="input-group-text">Bs</span>

                            </div>
                            
                        </div>
                        @error('costoAjuste')
                        <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                    @enderror









                        {{-- <div class="form-group">
                            <label>Costo Unit.</label>
                            <input type="number" wire:model.lazy="costoAjuste" class="form-control" placeholder="--"
                            {{ $nuevo_cantidad > $prod_stock ? '' : 'disabled=true' }}
                            >
                            @error('costo')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div> --}}
                    </div>
                    <div class="col">

                           <div class="form-group">

                            <label>Precio V.</label>
                            <div class="input-group">
                                <input type="number" style="max-height: 33px;" wire:model.lazy="pv_lote"
                                    class="form-control" placeholder="--"
                              >

                                <span class="input-group-text">Bs</span>

                            </div>
                        </div>
                        @error('pv_lote')
                        <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                    @enderror
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col">
                        <label for="floatingTextarea">Observacion:</label>
                        <textarea wire:model.lazy="observacion" class="form-control" placeholder="Agregar una observacion" id="floatingTextarea"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetEntradaSalida" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancelar</button>
                <button wire:click.prevent="guardarEntradaSalida()" type="button" class="btn btn-primary"
                    style="font-size: 13px">Guardar Ajuste</button>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('unidad-added', msg => {
            $('#modalUnidad').modal('hide'),
                $('#theModal').modal('show')
        });
    })
</script> --}}