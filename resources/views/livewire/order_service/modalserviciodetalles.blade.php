<div wire:ignore.self class="modal fade" id="serviciodetalles" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-center">
                <h5 class="modal-title text-white">
                    Información del Servicio - Orden de Servicio N°:{{ $this->id_orden_de_servicio }}
                </h5>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-1 text-center">
                            </div>

                            <div class="col-12 col-sm-4 col-md-10 text-center">
                                @if ($this->estado == 'PENDIENTE')
                                    <div class="text-center">
                                        <label>
                                            <h6>SERVICIO {{ $this->estado }}</h6>
                                        </label>
                                    </div>
                                @else
                                    @if ($this->estado == 'PROCESO')
                                        <div class="text-center">
                                            <label>
                                                <h2>SERVICIO EN {{ $this->estado }}</h2>
                                            </label>
                                        </div>
                                    @else
                                        @if ($this->estado == 'TERMINADO')
                                            <div class="text-center">
                                                <label>
                                                    <h2>SERVICIO {{ $this->estado }}</h2>
                                                </label>
                                            </div>
                                        @else
                                            @if ($this->estado == 'ENTREGADO')
                                                <label>
                                                    <div class="text-center">
                                                        <h2>SERVICIO {{ $this->estado }}</h2>
                                                    </div>
                                                </label>
                                            @else
                                                @if ($this->estado == 'ABANDONADO')
                                                    <label>
                                                        <div class="text-center">
                                                            <h2>SERVICIO {{ $this->estado }}</h2>
                                                        </div>
                                                    </label>
                                                @else
                                                    @if ($this->estado == 'ANULADO')
                                                        <label>
                                                            <div class="text-center">
                                                                <h2>SERVICIO {{ $this->estado }}</h2>
                                                            </div>
                                                        </label>
                                                    @else
                                                        {{ $this->estado }}
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            </div>

                            <div class="col-12 col-sm-4 col-md-1 text-center">
                            </div>

                            <div class="col-12 col-sm-4 col-md-1 text-center">

                            </div>

                            <div class="col-12 col-sm-4 col-md-10 text-center" style="color: #000000">
                                <b>Responsable Técnico:</b>
                                <span>
                                    {{ $this->responsabletecnico }}
                                </span>
                            </div>

                            <div class="col-12 col-sm-4 col-md-1 text-center">
                            </div>

                            <div class="col-12 col-sm-4 col-md-1 text-center">

                            </div>

                            <div class="col-12 col-sm-4 col-md-10 text-center" style="color: #000000">
                                <span class="stamp stamp">
                                    {{ ucwords(strtolower($this->categoriaservicio)) }} -
                                    {{ ucwords(strtolower($this->tipotrabajo)) }}
                                </span>
                            </div>

                            <div class="col-12 col-sm-4 col-md-1 text-center">
                            </div>

                            <div class="col-12 col-sm-4 col-md-6 text-center" style="color: #000000">
                                <h4><b>Cliente:</b> {{ ucwords(strtolower($this->nombrecliente)) }}</h4>
                            </div>

                            <div class="col-12 col-sm-4 col-md-6 text-center">
                                <h4>
                                    <b>Celular:</b> <a style="color: #000000"
                                        href="https://wa.me/{{ $this->celularcliente }}"
                                        target="_blank">{{ $this->celularcliente }}</a>
                                    <i style="color: #0080a7" class="fab fa-whatsapp"></i>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group" style="color: #000000">
                            <div class="col-md-6">
                                <b>
                                    Fecha Estimada de Entrega:
                                </b>
                                {{ \Carbon\Carbon::parse($this->fechaestimadaentrega)->format('d/m/Y h:i a') }}
                            </div>
                            <div class="col-md-6">
                                <b>
                                    Precio Servicio Bs:
                                </b>
                                {{ $this->precioservicio }}
                            </div>
                            <div class="col-md-6">
                                <b>
                                    Detalle Producto:
                                </b>
                                {{ $this->detalleservicio }}
                            </div>
                            <div class="col-md-6">
                                <b>
                                    A Cuenta Bs:
                                </b>
                                {{ $this->acuenta }}
                            </div>
                            <div class="col-md-6">
                                <b>
                                    Costo Servicio Bs:
                                </b>
                                {{ $this->costo }}
                            </div>
                            <div class="col-md-6">
                                <b>
                                    Saldo Bs:
                                </b>
                                {{ $this->saldo }}
                            </div>
                            <div class="col-md-6">
                                <b>
                                    Detalle Costo:
                                </b>
                                {{ $this->detallecosto }}
                            </div>

                            <div class="col-md-6">
                                <b>Tipo de Servicio:</b>
                                {{ $this->tiposervicio }}
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group text-center" style="color: #000000">
                            <div class="col-12 col-sm-4 col-md-12 text-center">
                                <b>Falla Según Cliente:</b>
                                <br>

                                <div class="detallesservicios">
                                    {{ $this->fallaseguncliente }}
                                </div>

                                <br>
                            </div>
                            <div class="col-12 col-sm-4 col-md-12 text-center">
                                <b>Diagnóstico</b>
                                <br>
                                <div class="detallesservicios">
                                    {{ $this->diagnostico }}
                                </div>
                                <br>
                            </div>
                            <div class="col-12 col-sm-4 col-md-12 text-center">
                                <b>Solución:</b>
                                <br>
                                <div class="detallesservicios">
                                    {{ $this->solucion }}
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

            </div>





            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button wire:click="informetecnico()" type="button" class="btn btn-primary">CREAR INFORME
                    TÉCNICO</button>
            </div>
        </div>
    </div>
</div>
