<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        {{ $componentName }} | NUEVA TRANSACCIÓN
                    </p>
                </h1>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>
                                Origen transacción
                            </label>
                            <select wire:model.lazy="origen" class="form-select">
                                <option value="Elegir" disabled selected>Elegir</option>
                                @foreach ($origenes as $orige)
                                    <option value="{{ $orige->id }}">{{ $orige->nombre }}</option>
                                @endforeach
                            </select>
                            @error('origen')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>
                                Cédula de identidad
                            </label>
                            <input @if ($mostrarCI == 0) disabled @endif type="number"
                                wire:model.lazy="cedula" class="form-control">
                            @error('cedula')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>
                                Motivo
                            </label>
                            <select @if ($origen == 'Elegir') disabled @endif wire:model.lazy="motivo"
                                class="form-select">
                                <option value="Elegir" disabled selected>Elegir</option>

                                @foreach ($motivos as $mot)
                                    <option value="{{ $mot->id }}">{{ $mot->nombre }}</option>
                                @endforeach

                            </select>
                            @error('motivo')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>
                                Teléfono solicitante
                            </label>
                            <input @if ($mostrartelf == 0) disabled @endif type="number"
                                wire:model.lazy="celular" class="form-control">
                            @error('celular')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class="col-sm-12 col-md-6">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>
                                    Monto
                                </label>
                                <input @if ($motivo == 'Elegir') disabled @endif type="number"
                                    wire:model="montoB" class="form-control" placeholder="">
                                @error('montoB')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-12">
                            <div class="form-group">
                                <label style="{{ $MostrarRadioButton == '0' ? 'color: #d97171' : 'color: #09ed3d' }}">
                                    ¿Con comisión? {{ $MostrarRadioButton == '0' ? 'No necesario' : 'Necesario' }}
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-radio radio-classic-primary">
                                    <input @if ($MostrarRadioButton == 0) disabled @endif type="radio"
                                        class="new-control-input" name="custom-radio-2" id="{{ $identificador }}"
                                        value="SI" wire:click="ComisionSi()">
                                    <span class="new-control-indicator"></span>
                                    Si
                                </label>
                                <label class="new-control new-radio radio-classic-primary">
                                    <input @if ($MostrarRadioButton == 0) disabled @endif type="radio"
                                        class="new-control-input" name="custom-radio-2" id="{{ $identificador2 }}"
                                        value="NO" wire:click="ComisionNo()">
                                    <span class="new-control-indicator"></span>
                                    No
                                </label>
                                @error('requerimientoComision')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-12">
                            <div class="form-group">
                                <label>
                                    Monto a registrar
                                </label>
                                <h6 class="form-control" wire:model.lazy="montoR">
                                    <strong>{{ $montoR }}</strong>
                                </h6>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>
                                    {{ $montoCobrarPagar }}
                                </label>
                                <h6 class="form-control" wire:model="importe"><strong>{{ $importe }}</strong>
                                </h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>
                                    Teléfono/Codigo Destino
                                </label>
                                <input @if ($mostrarTelfCodigo == 0) disabled @endif type="number"
                                    wire:model.lazy="codigo_transf" class="form-control">
                                @error('codigo_transf')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>
                                    Observaciones (opcional)
                                </label>
                                <textarea wire:model.lazy="observaciones" class="form-control" name="" rows="5"></textarea>
                                @error('observaciones')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="CargarAnterior()"
                    class="btn btn-secondary">
                    CARGAR ANTERIOR
                </button>
                <button type="button" wire:click.prevent="resetUI()"
                    class="btn btn-secondary">
                    LIMPIAR
                </button>
                <button type="button" wire:click.prevent="Store()" class="btn btn-primary">
                    GUARDAR
                </button>
            </div>
        </div>
    </div>
</div>