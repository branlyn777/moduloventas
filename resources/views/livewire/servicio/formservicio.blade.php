<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    Nuevo servicio de la Orden Nº
                    {{ $orderservice == '0' ? 'NO DEFINIDO' : $orderservice }}
                    | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}

                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>



            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>Tipo de Trabajo</label>
                            <select wire:model.lazy="typeworkid" class="form-select">
                                <option value="Elegir" disabled selected>Elegir</option>

                                @foreach ($work as $wor)
                                    @if ($wor->status == 'ACTIVE')
                                        <option value="{{ $wor->id }}" selected>{{ $wor->name }}</option>
                                    @endif
                                @endforeach

                            </select>
                            @error('typeworkid')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>
                                <span class="text-warning">* </span>Tipo de equipo
                            </label>
                            <select wire:model.lazy="catprodservid" class="form-select">
                                <option value="Elegir" disabled selected>Elegir</option>

                                @foreach ($cate as $cat)
                                    @if ($cat->estado == 'ACTIVO')
                                        <option value="{{ $cat->id }}" selected>{{ $cat->nombre }}</option>
                                    @endif
                                @endforeach

                            </select>
                            @error('catprodservid')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>
                                <span class="text-warning">*</span>Marca
                            </label>
                            <div class="product-search">
                                <input required  type="text" id="product-input" wire:model.lazy="marc" class="form-control">
                                <ul id="product-list"></ul>
                            </div>
                            @error('marc')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>
                                <span class="text-warning">* </span>Modelo y Estado del Equipo
                            </label>
                            <input type="text" wire:model.lazy="detalle" class="form-control"
                                placeholder="ej: Note 7 con protector de pantalla">
                            @error('detalle')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>
                                <span class="text-warning">* </span>Falla según el cliente
                            </label>
                            <input type="text" wire:model.lazy="falla_segun_cliente" class="form-control"
                                placeholder="ej: No carga">
                            @error('falla_segun_cliente')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>
                                Diagnóstico
                            </label>
                            <input type="text" wire:model.lazy="diagnostico" class="form-control"
                                placeholder="ej: Revisión">
                            @error('diagnostico')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>
                                Solución
                            </label>
                            <input type="text" wire:model.lazy="solucion" class="form-control"
                                placeholder="ej: Revisión">
                            @error('solucion')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>
                                Total
                            </label>
                            <input type="number" wire:model="import" class="form-control" placeholder="ej: 0.0">
                            @error('import')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>
                                A Cuenta
                            </label>
                            <input type="number" wire:model="on_account" class="form-control" placeholder="ej: 0.0">
                            @error('on_account')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>
                                Saldo
                            </label>
                            <input type="number" wire:model.lazy="saldo" class="form-control" placeholder="ej: 0.0"
                                disabled>
                            @error('saldo')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>
                                Responsable técnico
                            </label>
                            <select wire:model="userId" class="form-select" style="font-size: 90%">
                                <option value="0" disabled selected>Seleccione técnico</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>
                                Fecha Entrega
                            </label>
                            <input type="date" wire:model.lazy="fecha_estimada_entrega" class="form-control">
                            @error('fecha_estimada_entrega')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>
                                Hora Entrega
                            </label>

                            <input type="time" name="hora_entrega" wire:model.lazy="hora_entrega"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 col-md-4">

                        <div class="row">
                            <div class="col-5">
                                <br>
                                <button type="button" wire:click.prevent="resetUI()" wire:click="$emit('modal-hide')" class="btn btn-secondary" style="background: #3b3f5c">CANCELAR</button>
                            </div>
                            <div class="col-2">

                            </div>
                            <div class="col-5">
                                <br>
                                @if ($selected_id < 1)
                                    <button type="button" wire:click.prevent="Store()" class="btn btn-primary">GUARDAR</button>
                                @else
                                    <button type="button" wire:click.prevent="Update()" class="btn btn-primary">ACTUALIZAR</button>
                                @endif
                            </div>
                        </div>

                        
                            
                    </div>
                    @if ($selected_id > 0)
                        @if ($opciones != 'ENTREGADO')
                            <div class="col-lg-5 col-sm-12 col-md-4">
                                <label>
                                    Estado del Servicio
                                </label>
                                <select wire:model.lazy="opciones" class="form-control">
                                    @if ($estatus == 'PENDIENTE')
                                        <option value="PENDIENTE">PENDIENTE</option>
                                    @endif
                                    @if ($estatus == 'PROCESO')
                                        <option value="PENDIENTE">PENDIENTE</option>
                                        <option value="PROCESO">PROCESO</option>
                                    @endif
                                    @if ($estatus == 'TERMINADO')
                                        <option value="PENDIENTE">PENDIENTE</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                    @endif
                                    @if ($estatus == 'ABANDONADO')
                                        <option value="PENDIENTE">PENDIENTE</option>
                                        <option value="PROCESO">PROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                        <option value="ABANDONADO">ABANDONADO</option>
                                    @endif
                                    {{-- @if ($opciones == 'ENTREGADO')
                                    <option value="PENDIENTE" >PENDIENTE</option>
                                    <option value="PROCESO" >PROCESO</option>
                                    <option value="TERMINADO" >TERMINADO</option>
                                    <option value="ENTREGADO" >ENTREGADO</option>
                                @endif --}}
                                </select>
                                @error('opciones')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    @endif
                </div>

                {{-- <div class="modal-footer">
                    
                </div> --}}
            </div>
        </div>
    </div>
</div>