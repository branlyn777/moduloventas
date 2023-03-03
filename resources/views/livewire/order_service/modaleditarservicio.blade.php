<div wire:ignore.self class="modal fade" id="editarservicio" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    Editar Servicio - Orden de Servicio N°:{{ $this->id_orden_de_servicio }}
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>

                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="text-center">
                    <label>
                        <h5><b>{{ strtoupper($this->nombrecliente) }}</b> - {{ $this->celularcliente }}</h5>
                    </label>
                </div>


                <form class="needs-validation">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="validationTooltip01">Tipo de Trabajo</label>
                                    <select class="custom-select form-select" wire:model.lazy="edit_tipodetrabajo"
                                        required>
                                        <option value="">Seleccionar</option>
                                        @foreach ($listatipotrabajo as $item)
                                            <option value="{{ $item->id }}">{{ ucwords(strtolower($item->name)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('edit_tipodetrabajo')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="validationTooltip01">Categoría Trabajo</label>
                                    <select class="custom-select form-select" wire:model.lazy="edit_categoriatrabajo"
                                        required>
                                        <option value="">Seleccionar</option>
                                        @foreach ($listacategoriatrabajo as $i)
                                            <option value="{{ $i->id }}">{{ ucwords(strtolower($i->nombre)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('edit_categoriatrabajo')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="validationTooltipUsername">Marca/Modelo</label>

                                    <datalist id="marca">
                                        @foreach ($marcas as $cat)
                                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </datalist>
                                    <input list="marca" type="text" wire:model.lazy="edit_marca"
                                        class="form-control" placeholder="Huawei, Samsung, etc..." required>

                                    @error('edit_marca')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12 col-md-8">
                                <div class="form-group">
                                    <label for="validationTooltipUsername">Detalle Equipo</label>
                                    <div class="input-group">
                                        <input type="text" wire:model.lazy="edit_detalle" class="form-control"
                                            placeholder="Redmi Note 4 Blanco, Huawei Y9 Prime Azul, Portatil Asus sin Cable, Samsung A11 Color Plomo Oscuro, etc..."
                                            required>
                                    </div>
                                    @error('edit_detalle')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12 col-md-8">
                                <div class="form-group">
                                    <label for="validationTooltipUsername">Falla Según Cliente</label>
                                    <div class="input-group">
                                        <input type="text" wire:model.lazy="edit_fallaseguncliente"
                                            class="form-control"
                                            placeholder="No Funciona Internet, No Carga, No Enciende, etc..." required>
                                    </div>
                                    @error('edit_fallaseguncliente')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-8">
                                <div class="form-group">
                                    <label for="validationTooltipUsername">Diagnóstico Previo</label>
                                    <div class="input-group">
                                        <input type="text" wire:model.lazy="edit_diagnostico" class="form-control"
                                            placeholder="Configurar Apn, Probar Otro Cable de Carga, Cambiar Tecla Encendido, etc..."
                                            required>
                                    </div>
                                    @error('edit_diagnostico')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-8">
                                <div class="form-group">
                                    <label for="validationTooltipUsername">Solución</label>
                                    <div class="input-group">
                                        <input type="text" wire:model.lazy="edit_solucion" class="form-control"
                                            placeholder="Se Cambio el Socalo, Se Limpio la Placa, Se Reinstalo el Sistema Operativo etc..."
                                            required>
                                    </div>
                                    @error('edit_solucion')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-5 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="validationTooltip01">Motivo Costo Servicio Bs</label>
                                        <input type="text" wire:model="edit_motivocostoservicio" class="form-control"
                                            placeholder="Se Compró Pantalla Nueva, Se Compró Nuevo Sócalo, Se Compró SSD, etc...">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="validationTooltip01">Costo Bs</label>
                                        <input type="number" wire:model.lazy="edit_costoservicio" class="form-control">
                                    </div>
                                    @error('edit_costoservicio')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>




                            <div class="col-lg-3 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="validationTooltip01">Precio del Servicio Bs</label>
                                        <input type="number" wire:model.lazy="edit_precioservicio"
                                            class="form-control">
                                    </div>
                                    @error('edit_precioservicio')
                                        <span class="text-danger er">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="validationTooltip01">A Cuenta Bs</label>
                                        <input type="number" wire:model="edit_acuenta" class="form-control">
                                    </div>
                                </div>
                            </div>

                            @if (Auth::user()->hasPermissionTo('Cambiar_Tecnico_Responsable'))

                                <div class="col-lg-7 col-sm-12 col-md-7">
                                    {{-- <div class="form-group">
                                        {{-- <div class="col-md-12">
                                    <label for="validationTooltip01">Cambiar Técnico</label>
                                    <input type="number" wire:model.lazy="edit_precioservicioterminado" class="form-control">
                                </div> 
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="col-md-12 text-center">
                                            @if ($this->tipo == 'PENDIENTE')
                                                <label for="validationTooltip01">Cambiar Técnico Receptor</label>
                                            @else
                                                <label for="validationTooltip01">Cambiar Técnico Responsable</label>
                                            @endif
                                            <select wire:model="id_usuario" class="form-select">
                                                @foreach ($this->lista_de_usuarios as $i)
                                                    <option value="{{ $i->idusuario }}">{{ $i->nombreusuario }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    {{-- <div class="form-group-">
                                        {{-- <div class="col-md-12">
                                    <label>Saldo Bs</label>
                                    <div class="text-center">
                                        <label for="validationTooltipUsername"> <h2>{{number_format($this->edit_saldoterminado,2)}}</h2> </label>
                                    </div>
                                </div> 
                                    </div> --}}
                                </div>
                            @endif

                            <div class="col-lg-3 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label for="validationTooltip01">Fecha de Entrega</label>
                                    <input type="date" wire:model.lazy="edit_fechaestimadaentrega"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="validationTooltip01">Hora</label>
                                    <input type="time" wire:model.lazy="edit_horaentrega" class="form-control">
                                </div>
                            </div>




                            <div class="col-lg-3 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Saldo Bs</label>
                                        <div class="text-center">
                                            <label for="validationTooltipUsername">
                                                <h2>{{ number_format($this->edit_saldo, 2) }}</h2>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" wire:click="actualizarservicio()">Actualizar</button>
                @if ($this->mostrarterminar == 'Si')
                    <button type="button" class="btn btn" style="background-color: rgb(224, 146, 0)"
                        wire:click="terminarservicio()"
                        title="Registrar Servicio Terminado con todos estos datos">Terminar Servicio</button>
                @endif

            </div>
        </div>
    </div>
</div>
