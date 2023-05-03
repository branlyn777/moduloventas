<div wire:ignore.self id="modal-ajuste" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <div class="modal-header bg-primary">
                <h4 class="text-white text-sm" id="exampleModalLabel">
                    Ajustar Cartera
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Cartera</label>
                            <select wire:model='cartajusteselected' class="form-select">
                                <option value=null selected disabled>Elegir</option>
                                @foreach ($carterasAjuste as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->carteranombre }}</option>
                                @endforeach
                            </select>
                            @error('cartera_id')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Saldo Cartera</label>
                            <br>
                            <h6 class="badge badge-lg bg-primary p-2 text-center text-lg">{{ $saldo_cartera_aj ?? 0 }}
                            </h6>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Nuevo Saldo</label>
                            <input type="number"
                                onkeypress="if(event.keyCode < 46 || event.keyCode > 57 || event.keyCode == 47) event.returnValue = false;"
                                required wire:model.lazy="cantidad" class="form-control">
                            @error('cantidad')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Comentario (Obligatorio)</label>
                            <textarea wire:model.lazy="comentario" class="form-control" name="" rows="2"></textarea>
                            @error('comentario')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" wire:click.prevent="resetAjuste()">Cancelar</button>
                    <button class="btn btn-primary" wire:click.prevent="guardarAjuste()">Guardar</button>
                </div>

            </div>


        </div>
    </div>
</div>
